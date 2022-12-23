<?php

namespace App\Repositories;

use App\Events\RetailerRegisterEvent;
use App\Models\Retailer;
use App\Repositories\Interfaces\RetailerInterface;
use Illuminate\Support\Facades\DB;

class RetailerRepository implements RetailerInterface
{
    public function store($data)
    {
        $input= $data->except('_token');
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
        $password = substr($random, 0, 10);
        // $password = str_random(10);
        $input['password'] = bcrypt($password);
        $is_active = 1;
        $input['is_active'] = $is_active;
        $is_deleted = 0;
        $input['is_deleted'] = $is_deleted;
        $role_id = 10;
        $input['role_id'] = $role_id;
        DB::beginTransaction();
        try {
            $retailer = Retailer::create($input);
            $mailData = [
                'title' => 'Mail from ERP',
                'body' => 'Your Account Credentials.',
                'email' => $data['email'],
                'name' => $input['name'],
                'password' => $password,
            ];
            event(new RetailerRegisterEvent($mailData));
            DB::commit();
            return $retailer;
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
        
    }
    public function update($data, $item)
    {
        $input = $data->except('_token');
        DB::beginTransaction();
        try {
            $data = $item->update($input);
            DB::commit();
            return $item;
            
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }
    public function delete($item)
    {
        $is_active = 0;
        $input['is_active'] = $is_active;
        try {
            $item->update($input);
            $data = $item->delete();
            return $data;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}