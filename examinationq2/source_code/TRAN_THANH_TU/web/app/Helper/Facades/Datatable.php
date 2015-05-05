<?php

namespace Helper\Facades;

class Datatable
{

    public $model;
    public $columns = [];
    public $search = [];
    public $condition = null;
    public $primary = null;

    public function render()
    {
        $request = \Input::all();
        if($this->primary == null){
            $key = 'id';
        }else{
            $key = $this->primary;
        }
        $params = [
            'offset' => !empty($request['start']) ? $request['start'] : 0,
            'limit' => !empty($request['length']) ? $request['length'] : 10,
            'order' => !empty($request['order'][0]['column']) ? $this->columns[$request['order'][0]['column']] : $this->primary,
            'sort' => !empty($request['order'][0]['dir']) ? $request['order'][0]['dir'] : 'asc',
            'searchValue' => !empty($request['search']['value']) ? $request['search']['value'] : null,
        ];

        $query = $this->model;
        // select columns
        $query = $query->select($this->columns);
        // buid seach  
        foreach ($this->search as $seachKey) {
            $query = $query->orWhere($seachKey, 'like', '%' . $params['searchValue'] . '%');
            if($this->condition != null){
                $query = $query->where('id','<>',$this->condition);
            }
        }
        // count total
        $total = $query->count();
        // set limit
        $query = $query->skip($params['offset']);
        $query = $query->take($params['limit']);
        // order by
        $query = $query->orderBy($params['order'], $params['sort']);
        // get data
        $data = $query->get()->toArray();

        $output = [
            'draw' => $request['draw'],
            'recordsFiltered' => $total,
            'recordsTotal' => $total,
            'data' => array()
        ];
        foreach ($data as $rows) {
            $dataRow = array();
            foreach ($this->columns as $col) {
                $dataRow[$col] = $rows[$col];
            }
            $output['data'][] = $dataRow;
        }
        return json_encode($output);
    }

    public static function request($columns = array(), $order = 'id', $sort = 'asc')
    {
        $request = \Input::all();
        $params = [
            'offset' => !empty($request['start']) ? $request['start'] : 0,
            'limit' => !empty($request['length']) ? $request['length'] : 10,
            'order' => !empty($request['order'][0]['column']) ? $columns[$request['order'][0]['column']] : $order,
            'sort' => !empty($request['order'][0]['dir']) ? $request['order'][0]['dir'] : $sort,
            'search' => !empty($request['search']['value']) ? $request['search']['value'] : null,
        ];
        return $params;
    }

    public static function output($data, $totalCount = 0)
    {
        $request = \Input::all();
        $output = [
            'draw' => !empty($request['draw']) ? $request['draw'] : 0,
            'recordsFiltered' => $totalCount,
            'recordsTotal' => $totalCount,
            'data' => $data
        ];
        return json_encode($output);
    }

}
