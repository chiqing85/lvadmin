<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;

class UploadController extends Controller
{
    protected function checkPath( $path ) {
        if(is_dir( $path )) {
            return true;
        }

        if( mkdir( $path, 0755, true)) {
            return true;
        } else {
            return $this->error('目录创建失败！');
        }
    }

    /**
     * @title 上传图片
     * @param Request $request
     * @return string
     */
    public function image( Request $request) {

        $path = $request->file('images')
            ->storePublicly( md5( time() ) );

        return '/storage/'. $path;
        //  return asset('storage/'. $path );
    }

    /**
     * @title 编辑器上传图片
     * @param Request $request
     */
    public function editor( Request $request ) {
        if($request->file('editormd-image-file')){
            $path = $request->file('editormd-image-file')
                    ->storePublicly( md5( time() ) );

            if( $path ) {
                $message = '图片上传成功';
                $url = '/storage/'. $path;
            }
        } else {
            $message = 'Not File';
        }
        $data = array(
            'success' => empty($message) ? 0: 1,
             'message' => $message,
             'url' => !empty($url) ? $url : '',
        );
        exit( json_encode( $data ) );
    }

    /**
     * @title 缩略图
     * @param Request $request
     * @return string
     */

    public function thumb( Request $request) {
        $file = $request->file('images');
        if( $file ) {
            if( getimagesize($file)[0] > $request->input('size') )
            {
                $this->checkPath( 'storage/'. md5( time() ).'/');
                $filename = $file->getClientOriginalName();
                $ext = $file->getClientOriginalExtension();
                $img = Image::make( $file );
                $img->resize( $request->input('size'), null , function($constraint){
                    $constraint->aspectRatio();
                })->save( public_path('storage/'.  md5( time() ) .'/'. md5(  $filename ) ) . '.'. $ext);
                return '/storage/' . md5( time() ) .'/'. md5(  $filename ). '.' .$ext;
            } else {
                $path = $file->storePublicly( md5( time() ) );
                return '/storage/'. $path;
            }
        }
    }
}
