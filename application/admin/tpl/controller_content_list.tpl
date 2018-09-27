<!DOCTYPE html>
<html>
    <head>
        {layout name="public/layout" /}
    </head>
    <body>
        <div class="page-content">
            <div class="Role_Manager_style">
                <div class="Manager_style">
                    <div class="title_name">菜单列表</div>
                    <a href="javascript:location.reload();" class="flash" title="刷新"></a>
                    <button type="button" class="btn btn-primary btn-redirect btn-current" name="{:url('@controller@/index')}">@name@列表</button>
                    <button type="button" class="btn btn-primary btn-redirect" name="{:url('@controller@/modify')}">添加@name@</button>
                    <button type="button" class="btn btn-primary btn-redirect" name="{:url('@controller@/category')}">@name@类别列表</button>
                    <button type="button" class="btn btn-primary btn-redirect" name="{:url('@controller@/categoryModify')}">添加@name@类别</button>
                </div>
                <div class="Manager_style">
                    <div class="title_name">@name@列表</div>
                    <div class="Role_list">
                        <form action="" method="get">
                            <div class="controlsWrap">
                                <div class="mainWrap">
                                    
                                    <section class="v-block">
                                        <label class="v-lab">栏目名称</label>
                                        <input class="v-inp" type="text" name="name" value="{$name}" placeholder="栏目名称" />
                                    </section>

                                    <section class="v-block">
                                        <label class="v-lab">所属分类</label>
                                        <select name="parent_id" class="v-sel">
                                            <option value="0">全部</option>
                                            {volist name="parent_list" id="vo"}
                                                <option value="{$vo['cat_id']}">{$vo['cat_name']}</option>
                                            {/volist}
                                        </select>
                                        <script type="text/javascript">
                                            $("select[name=parent_id] option[value={$parent_id}]").attr('selected','selected');
                                        </script>
                                    </section>

                                    <section class="v-block">
                                        <label class="v-lab">创建日期</label>
                                        <input class="input v-inp" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" class="date" type="text" name="btime"  placeholder="开始时间" value="{$btime}" />
                                        <em class="v-sti">-</em>
                                        <input class="input v-inp" onclick="WdatePicker({dateFmt:'yyyy-MM-dd'})" class="date" type="text" name="etime" placeholder="结束时间" value="{$etime}"/>
                                    </section>

                                </div>
                                <div class="RightWrap">
                                    <button class="input-search" type="submit">搜索</button>
                                </div>
                            </div>
                        </form>
                        <table id="Role_list" cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>选择</th>
                                    <th>ID</th>
                                    <th>名称</th>
                                    <th>所属类别</th>
                                    <th>更新日期</th>
                                    <th>是否显示</th>
                                    <th>排序</th>
                                    <th>操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                {volist name="lists" id="vo"}
                                    <tr>
                                        <td><input type="checkbox" name="checkbox" data-id="{$vo['id']}"/></td>
                                        <td>{$vo['id']}</td>
                                        <td>{$vo['title']}</td>
                                        <td>{$vo['cat_name']}</td>
                                        <td>{$vo['create_time']|date="Y-m-d H:i:s"}</td>
                                        <td class="edit_show" data-table="content" data-id="{$vo['id']}" data-value="{$vo['is_show']}" data-key="is_show">
                                            {if $vo['is_show'] eq 1}
                                                <span class="span-yes"><img src="/public/static/admin/images/yes.png"/></span>
                                            {else}
                                                <span class="span-no"><img src="/public/static/admin/images/cancel.png"/></span>
                                            {/if}
                                        </td>
                                        <td class="edit_order" data-table="content" data-id="{$vo['id']}" data-value="{$vo['order_id']}" data-key="order_id">
                                            <span>{$vo['order_id']}</span>
                                            <input type="text" name="order_id" style="width: 60px;display: none;" class="edit_order_input" value="{$vo['order_id']}" />
                                        </td>
                                        <td>  
                                            <button type="button" class="btn btn-primary btn-redirect" name="{:url('@controller@/modify',array('id'=>$vo['id']))}">修改</button> 
                                            <button type="button" class="btn btn-warning btn-delete" name="{:url('@controller@/delete',array('id'=>$vo['id']))}">删除</button>
                                        </td>
                                    </tr>
                                {/volist}
                            </tbody>
                        </table>
                        {$lists|raw}
                        <div class="all-operate">
                            <label class="list-all-check"><input type="checkbox" id="checkbox"/><em>全选/反选</em></label>
                            <button id="mutidels" data-url="{:url('@controller@/delete')}">批量删除</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>