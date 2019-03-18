<?php

class DbManager extends PDO {
	public function __consruct($dsn, $user, $pass, $options = []) {
		try {
			parent::__consruct($dsn, $user, $pass, $options);
			$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (Exception $e) {
			print_r($e);
		}
	}

	public function search($tblName, $conditions = FALSE, $order = FALSE, $limit = NULL, $selFields = FALSE, $group = FALSE, $relation = '=') {
		$selFieldSql = $orderBySql = $whereSql = $groupBySql = '';
		if ($selFields) {
			$selFieldSql = is_array($selFields) ? implode(', ', $selFields) : $selFields;
		} else $selFieldSql = '*';
		$whereSql = $this->genQuery($conditions, NULL, $relation);
		$orderBySql = '';
		if ($order) {
			if (is_array($order)) {
				if (is_array($order[0])) {
					$tmpArSort = array();
					foreach ($order as $sort) {
						if (!$sort[1]) $sort[1] = 'ASC';
						$tmpArSort[] = $sort[0] . ' ' . $sort[1];
					}
					$orderBySql .= 'ORDER BY ' . implode(', ', $tmpArSort) . ' ';
				} else $orderBySql .= 'ORDER BY ' . $order[0] . ' ' . $order[1] . ' ';
			} else $orderBySql .= 'ORDER BY ' . $order . ' ASC ';
		}
		if ($group) {
			if (is_array($group)) $groupBySql =  'GROUP BY ' . implode(', ', $group) . '';
			else $groupBySql = 'GROUP BY ' . $group . '';
		} else $groupBySql = '';
		if (!is_null($limit)) {
			$limitSql = is_array($limit) ? " LIMIT $limit[0], $limit[1]" : " LIMIT $limit ";
		} else {
			$limitSql = '';
		}
		$stmt = $this->query("SELECT $selFieldSql FROM $tblName WHERE $whereSql $groupBySql $orderBySql $limitSql");
		//var_dump($stmt);
		return $stmt;
	}
	public function getRecord($tblName, $conditions, $limit = NULL, $selFields = NULL, $relation = '=') {
		if ($selFields) {
			$selFieldSql = is_array($selFields) ?  implode(', ', $selFields) : $selFields;
		} else $selFieldSql = '*';
		if (is_null($limit)) $limit = 1;
		$whereSql = $this->genQuery($conditions, $limit, $relation);
		$tblName = is_array($tblName) ? implode(', ', $tblName) : $tblName;
		$stmt = $this->query("SELECT $selFieldSql FROM $tblName WHERE $whereSql");
		$lmt = is_array($limit) ? $limit[1] : $limit;
		if ($stmt && $lmt == 1) {
			return $stmt->fetch(PDO::FETCH_ASSOC);
		} else {
			return $stmt;
		}
	}	

	public function updateRecord($tblName, $conditions, $values, $limit = 1) {
		if ($values) {
			$arUpdateField = array();
			foreach ($values as $field => $value) {
				$value = $this->quote($value);
				$arUpdateField[] = "$field = $value";
			}
			$fields = implode(', ', $arUpdateField);
		}
		$whereSql = $this->genQuery($conditions, $limit);
		return $this->exec("UPDATE $tblName SET $fields WHERE $whereSql");
	}

	public function insertRecord($tblName, $arValues, $upsert = false) {
		if (is_assoc_array($arValues)) {
			$arValues = array($arValues);
		}
		$keys = array_keys($arValues[0]);
		$fields = '(' . implode(', ', $keys) . ')';
		foreach ($arValues as $values) {
			$arVal[] = '(' . implode(', ', array_map(array($this, 'quote'), $values)) . ")";
		}
		$values = implode(', ', $arVal);
		
		if ($upsert) {
			$keys = is_array($upsert) ? $upsert : $keys;
			$arUpdateField = [];
			foreach ($keys as $key) {
				$arUpdateField[] = "$key = VALUES($key)";
			}
			$suffix = ' ON DUPLICATE KEY UPDATE ' . implode(', ', $arUpdateField);
		} else {
			$suffix = '';
		}
		return $this->exec("INSERT INTO $tblName $fields VALUES {$values}{$suffix}");
	}
	public function deleteRecord($tblName, $conditions, $limit = 1) {
		$whereSql = $this->genQuery($conditions, $limit);
		return $this->exec("DELETE FROM $tblName WHERE $whereSql");
	}
	public function getNumRows($tblName, $condition) {
		$condition = $this->genQuery($condition);
		$result = $this->query("SELECT COUNT(*) FROM $tblName WHERE $condition");
		return $result ? $result->fetchColumn() : 0;
	}
	public function getLastInsertID() {
		$result = $this->query('SELECT LAST_INSERT_ID()');
		return $result ? $result->fetchColumn() : false;
	}
	public function genQuery($conditions, $limit = NULL, $relation = '=') {
		$arCondition = array();
		$sql = '';
		if (is_array($conditions) && !empty($conditions)) {
			if (is_assoc_array($conditions)) {
				$logic = (isset($conditions[0]) && $conditions[0]) ? ' OR ' : ' AND ';
				unset($conditions[0]);
				foreach ($conditions as $field => $value) {
					if (is_array($value)) {
						if ($relation === '=') {
							$quotedValue = array_filter($value, 'is_numeric') ? $value : array_map([$this, 'quote'], $value);
							$arCondition[] = "$field IN (" . implode(', ', $quotedValue) . ")";
						} else {
							foreach ($value as $option) {
								$arOption[] = "$field $relation " . $this->quote($option);
							}
							$arCondition[] = ' ( ' . implode(' OR ', $arOption) . ' ) ';
						}
					} else {
						$arCondition[] = "$field $relation " . $this->quote($value);
					}
				}
				$sql = implode($logic, $arCondition);
			} else {
				$cnt = count($conditions);
				if (is_array($lElm = $conditions[$cnt - 1]) || !is_string($lElm)) $logic = ' AND ';
				else {
					$logic = $lElm ? ' OR ' : ' AND ';
					$cnt--;
				}
				for ($i = 0; $i < $cnt; $i++) {
					$arCondition[] = $this->genQuery($conditions[$i], NULL, $relation);
				}
				$sql = implode($logic, $arCondition);
			}
		} elseif ($conditions instanceof \Query\Condition) {
			$gen = new \Query\Generator_Sql($this);
			$sql = $gen->condition($conditions);
		} elseif ($conditions) {
			$sql = $conditions;
		}
		
		$sql = empty($sql) ? 1 : "( $sql )";
		if (!is_null($limit)) {
			if (is_array($limit)) $sql .= " LIMIT $limit[0], $limit[1]";
			else $sql .= " LIMIT $limit ";
		}
		return $sql;
	}
}