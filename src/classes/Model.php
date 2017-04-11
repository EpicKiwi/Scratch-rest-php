<?php
interface Model
{
    public static function findAll();
    public static function findOne($id);
    public function save();
    public function remove();
}