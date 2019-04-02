<?php

namespace App\Http\Middleware;

use Closure;

class AuthToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $curl = request()->route()->getAction();
        $rull = strstr($curl['controller'], str_replace('/', '', $curl["prefix"]) );
        // 获取当前节点 id
        $rule = \App\AuthRule::where('name', $rull)
              ->get(['id','pid' , 'title']);

        if( ! $rule->isEmpty() ) {
            // 用户所拥有的所有权限
            $ids = array();
            foreach (\Auth::user()->group as $g ) {
                $ids = array_merge($ids, explode(',', trim($g['rules'], ',')));
            } ;
            $colle = collect([$rule[0]->id]);

            // 查询当前用户是否拥有权限
            if (! $colle->intersect( array_unique( $ids ) )->count() ) {
                $type = $rule[0]->pid ? '操作' : '访问';
                $data = [
                    'code' => 403,
                    'secc' => '很抱歉，你没有' .$type . $rule[0]->title . '模块权限'
                ];
                 return response()->json($data );
            }
        }

        return $next($request);
    }
}
