<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserModel;
use App\Http\Controllers\Api\Notification;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        try {

            $data = UserModel::all();
            if ($data !== "") {
                echo json_encode([
                    "status" => "success",
                    "message" => "สำเร็จ",
                    "data" => $data,

                ]);
                return;
            } else {
                echo json_encode([
                    "status" => "failed",
                    "message" => "ไม่พบข้อมูล",
                    "data" => null,

                ]);
                return;
            }
        } catch (Exception $e) {
            echo json_encode([
                "status" => "failed",
                "message" => "เกิดข้อผิดพลาด",
                "data" => $e,

            ]);
            return;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->validate([

                'firstname' => 'required',
                'lastname' => 'required',
                'username' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'password' => 'required',

            ]);
            $users =  new UserModel;
            $users->firstname = $request->firstname;
            $users->lastname = $request->lastname;
            $users->username = $request->username;
            $users->email = $request->email;
            $users->phone = $request->phone;
            $users->password = $request->password;
            $users->save();

            if ($users) {

                $Notification = new Notification();
                $LineNotify = $Notification->notification($users);

                echo json_encode([
                    "status" => "success",
                    "message" => "บันทึกสำเร็จ",
                    "data" => $users,

                ]);
                return $LineNotify;
            } else {
                echo json_encode([
                    "status" => "failed",
                    "message" => "บันทึกไม่สำเร็จ",
                    "data" => null,

                ]);
                return;
            }
        } catch (Exception $e) {
            echo json_encode([
                "status" => "failed",
                "message" => "เกิดข้อผิดพลาด",
                "data" => $e,

            ]);
            return;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(UserModel $userModel)
    {
        try {
            return response()->json($userModel);
        } catch (Exception $e) {
            return response()->json(null);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([

                'firstname' => 'required',
                'lastname' => 'required',
                'username' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'password' => 'required',

            ]);
            $users =  UserModel::find($id);
            $users->firstname = $request->firstname;
            $users->lastname = $request->lastname;
            $users->username = $request->username;
            $users->email = $request->email;
            $users->phone = $request->phone;
            $users->password = $request->password;
            $users->save();

            if ($users) {

                echo json_encode([
                    "status" => "success",
                    "message" => "บันทึกสำเร็จ",
                    "data" => $users,

                ]);
                return;
            } else {
                echo json_encode([
                    "status" => "failed",
                    "message" => "บันทึกไม่สำเร็จ",
                    "data" => null,

                ]);
                return;
            }
        } catch (Exception $e) {
            echo json_encode([
                "status" => "failed",
                "message" => "เกิดข้อผิดพลาด",
                "data" => $e,

            ]);
            return;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserModel $userModel)
    {
        $userModel->delete();
        echo json_encode([
            "status" => "failed",
            "message" => "เกิดข้อผิดพลาด",
            "data" => $userModel,

        ]);
    }
}
