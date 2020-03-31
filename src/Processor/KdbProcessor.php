<?php

namespace I421\Kdb\Processor;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\Processors\Processor;

class KdbProcessor extends Processor
{
    // 这个方法用来修改查询结果的编码，因为金仓v7数据不支持utf-8编码修改 所以在直接把数据库查询出来的结果修改编码
    public function processSelect(Builder $query, $results)
    {
        foreach($results as &$result){
            foreach($result as $key => $value){
                if(json_encode($value)=== false) {
                    $result->$key = mb_detect_encoding($value, array('GBK', 'UTF-8')) != 'UTF-8'?iconv('GBK','UTF-8', $value):$value;
                }
            }
        }
        return $results;
    }


    /**
     * Process an "insert get ID" query.
     *
     * @param  \Illuminate\Database\Query\Builder  $query
     * @param  string  $sql
     * @param  array   $values
     * @param  string  $sequence
     * @return int
     */
    public function processInsertGetId(Builder $query, $sql, $values, $sequence = null)
    {
        $result = $query->getConnection()->selectFromWriteConnection($sql, $values)[0];

        $sequence = $sequence ?: 'id';

        $id = is_object($result) ? $result->{$sequence} : $result[$sequence];

        return is_numeric($id) ? (int) $id : $id;
    }

    /**
     * Process the results of a column listing query.
     *
     * @param  array  $results
     * @return array
     */
    public function processColumnListing($results)
    {
        return array_map(function ($result) {
            return with((object) $result)->column_name;
        }, $results);
    }
}
