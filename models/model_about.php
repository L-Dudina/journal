<?php 
class Model_About extends Model 
{ 
    public function get_data($id = -1) 
    { 
        // Если передаем id нашего автора, выбираем только одну запись
        if ($id != -1) { 
            // Параметризованный запрос для безопасности
            $result = $this->executeQuery("SELECT * FROM authors WHERE id = ?", [$id]); 
        } else { 
            // Если id равно -1, то возвращаем весь список авторов
            $result = $this->executeQuery("SELECT * FROM authors"); 
        } 
        return $result; 
    }
} 
?>
