<?php namespace App\Libraries;

/**
 * Credits:
 * DataTables server-side processing for CodeIgniter4
 * A CodeIgniter4 library for building a Datatables server side processing SQL query.
 * URL: https://github.com/sluvanda/codeigniter4-datatables
 * Developer: https://github.com/sluvanda
 */

use Config\Services;

class DataTable
{
    public function process($modelClass, $columns, $where = [])
	{
        helper('formatter');
        
        $modelClass = '\\App\\Models\\'.$modelClass;
        $model = new $modelClass;
        
        foreach ($columns as $column)
        {
            $fields[] = $column['name'];
        }

        $select = implode(', ', $fields);
        
        $model->select($select);

        if (empty($where) === false)
        {
            $model->where($where);
        }
        
        $request = Services::request();
        $get = $request->getGet();
        
        $getColumns = $get['columns'];
        
        foreach ($get['order'] as $order)
        {
            if ($getColumns[$order['column']]['orderable'] === 'true')
            {
                $model->orderBy($columns[$order['column']]['name'], strtoupper($order['dir']));
            }
        }
        
        $recordsTotal = $model->countAllResults(false);
        $match = $get['search']['value'];
        
        if (empty($match) === false)
        {
            $count = 0;
            
            foreach ($getColumns as $getColumn)
            {
                if ($getColumn['searchable'] === 'true')
                {
                    $count += 1;
                    $field = $columns[$getColumn['data']]['name'];
                    
                    if ($count === 1)
                    {
                        $model->like($field, $match);
                    }
                    else
                    {
                        $model->orLike($field, $match);
                    }
                }
            }
        }
        
        $recordsFiltered = $model->countAllResults(false);
        
        $model->limit($get['length'], $get['start']);
        
        $rows = $model->find();
        $data = [];
        
        foreach ($rows as $row)
        {
            $i = 0;
            $d = [];
            
            foreach ($row as $value)
            {
                $column = $columns[$i];
                
                if (array_key_exists('formatter', $column) === true)
                {
                    $value = call_user_func($column['formatter'], $value, $row); 
                }
                
                $d[] = $value;
                $i += 1;   
            }

            $data[] = $d;
        }
        
        $response = [
            'draw' => intval($get['draw']),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data
        ];

        return $response;
    }
}