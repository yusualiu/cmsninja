<?php

class DatabaseTable{
  //class variables or parameters
  public $pdo;
  public $table;
  public $primaryKey;
  //query database
  private function query($sql,$parameters = [])
  {
    
    $query = $this->pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
  }
  
  //total record count
  public function total()
  {
    $query = $this->query('SELECT COUNT(*) FROM `' . $this->table . '`');
    $row = $query->fetch();
    return $row[0];
  }

  //Find by id
  public function findById($value)
  {
    $query = 'SELECT * FROM `' . $this->table . '` WHERE
    `' . $this->primaryKey . '` = :value';
    $parameters = [
    'value' => $value
    ];
    $query = $this->query($query, $parameters);
    return $query->fetch();
  }

  // Insert record into table
  private function insert($fields)
  {
    $query = 'INSERT INTO `' . $this->table . '` (';
    foreach ($fields as $key => $value) {
      $query .= '`' . $key . '`,';
    }
    $query = rtrim($query, ',');
    $query .= ') VALUES (';
    
    foreach ($fields as $key => $value) {
      $query .= ':' . $key . ',';
    }
    $query = rtrim($query, ',');
    $query .= ')';
    $fields = $this->processDates($fields);
    $this->query($query, $fields);
  }

    //update record in table.
  private function update($fields)
  {
    $query = ' UPDATE `'.$this->table.'` SET ';
    foreach ($fields as $key => $value) {
    $query .= '`' . $key . '` = :' . $key . ',';
    }
    $query = rtrim($query, ',');
    $query .= ' WHERE `' . $primaryKey . '` = :primaryKey';
    // Set the :primaryKey variable
    $fields['primaryKey'] = $fields['id'];
    $fields = $this->processDates($fields);
    $this->query($query, $fields);
  }

  //Delete record from table
  public function delete($id)
  {
    $parameters = [':id' => $id];
    $this->query('DELETE FROM `' . $this->table . '` WHERE
    `'.$this->primaryKey.'` = :id', $parameters);
  }

  // List all record
  public function findAll()
  {
    $result = $this->query('SELECT * FROM ' . $this->table);
    return $result->fetchAll();
  }

  // Handle dates in mysql
  private function processDates($fields)
  {
    foreach ($fields as $key => $value) {
      if ($value instanceof DateTime) {
        $fields[$key] = $value->format('Y-m-d');
      }
    }
    return $fields;
  }

  // save record in database

  public function save($record)
  {
    try {
      if ($record[$primaryKey] == '') {
        $record[$primaryKey] = null;
      }
      $this->insert($record);
    }catch (PDOException $e) {
      $this->update($record);
    }
  }
}