<?php
	/**
	 * tpl单图展示
	 * @param  [type] $field [description]
	 * @return [type]        [description]
	 */
	function pic_show_tpl($field)
	{
		return '{if !empty($model["'.$field.'"])}
													            <li class="file">
													                <div class="file-panel">
													                    <span class="cancel">删除</span>
													                </div>
													                <div class="img">
													                    <img src="{$model["'.$field.'"]}" alt="">
													                </div>
													                <input type="hidden" name="'.$field.'" value="{$model["'.$field.'"]}" />
													            </li>
													        {/if}';
	}
	/**
	 * tpl多图展示
	 * @param  [type] $field [description]
	 * @return [type]        [description]
	 */
	function piclist_show_tpl($field)
	{
		return '{if is_array($model["'.$field.'"]) && !empty($model["'.$field.'"][0])}
                                                                {foreach $model["'.$field.'"] as $k=>$v}
                                                                    <li class="file">
                                                                        <div class="file-panel">
                                                                            <span class="cancel">删除</span>
                                                                        </div>
                                                                        <div class="img">
                                                                            <img src="{$v}" alt="">
                                                                        </div>
                                                                        <input type="hidden" name="'.$field.'[]" value="{$v}" />
                                                                    </li>
                                                                {/foreach}
                                                            {/if}';
		
	}
	/**
	 * tpl时间控件展示
	 * @param  [type] $field [description]
	 * @return [type]        [description]
	 */
	function time_show_tpl($field)
	{
		return '{$model["'.$field.'"]|date_show="Y-m-d H:i:s"}';
	}
	/**
	 * tpl字段显示
	 * @param  [type] $field [description]
	 * @return [type]        [description]
	 */
	function field_show_tpl($field)
	{
		return '{$model["'.$field.'"]}';
	}