<?php /* Smarty version 2.6.25-dev, created on 2015-09-29 22:15:54
         compiled from /var/www/public_html/includes/smarty/templates/lesson12.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_radios', '/var/www/public_html/includes/smarty/templates/lesson12.tpl', 26, false),array('function', 'html_options', '/var/www/public_html/includes/smarty/templates/lesson12.tpl', 59, false),array('modifier', 'default', '/var/www/public_html/includes/smarty/templates/lesson12.tpl', 26, false),)), $this); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Lesson 12</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    </head>
    <body style="width:500px;padding: 30px;">

        <div class="page-header">
            <h1>Подача объявлений</h1>
        </div>

 
        <form class="form-horizontal" method="POST" role="form">

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">

                    <?php echo smarty_function_html_radios(array('name' => 'organization_form_id','options' => $this->_tpl_vars['organization_form'],'selected' => ((is_array($_tmp=@$this->_tpl_vars['ad']->organization_form_id)) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)),'separator' => "&nbsp;"), $this);?>

                </div>
            </div>

            <div class="form-group">
                <label for="seller_name" class="col-sm-2 control-label">Ваше имя</label>
                <div class="col-sm-10">
                    <input type="text" name="seller_name" class="form-control" id="seller_name" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['ad']->seller_name)) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" placeholder="Ваше имя">
                </div>
            </div>
                
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Эл. почта</label>
                <div class="col-sm-10">
                    <input type="text" name="email" class="form-control" id="email" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['ad']->email)) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" placeholder="Электронная почта">
                </div>
            </div>
                
            <div class="checkbox">
                <label>
                    <input type="checkbox" value ="1" id="allow_mails" <?php echo $this->_tpl_vars['is_allow_mail']; ?>
> Я не хочу получать вопросы по объявлению по e-mail
                </label>
            </div>
                
            <div class="form-group">
                <label for="phone" class="col-sm-2 control-label">Телефон</label>
                <div class="col-sm-10">
                    <input type="text" name="phone" class="form-control" id="phone" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['ad']->phone)) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" placeholder="Номер телефона">
                </div>
            </div>

            <div class="form-group">
                <label for="phone" class="col-sm-2 control-label"></label>
                <div> <label for="region">Город</label> <?php echo smarty_function_html_options(array('name' => 'location_id','options' => $this->_tpl_vars['cities'],'selected' => $this->_tpl_vars['city_selected_id']), $this);?>
 </div>

                <div> <label for="region">Категория</label>                     <select title="Выберите категорию" name="category_id"  required>


                        <?php $_from = $this->_tpl_vars['labels']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['label']):
?>
                            <optgroup label="<?php echo $this->_tpl_vars['label']; ?>
">
                                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['subcategories'][$this->_tpl_vars['key']],'selected' => ((is_array($_tmp=@$this->_tpl_vars['category_selected_id'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, ''))), $this);?>

                            </optgroup>
                        <?php endforeach; endif; unset($_from); ?> 
                    </select> 
                </div>   
            </div>
                    
            <div class="form-group">
                <label for="title" class="col-sm-2 control-label">Название</label>
                <div class="col-sm-10">
                    <input type="text" name="title" class="form-control" id="title" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['ad']->title)) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" placeholder="Название" required>
                </div>
            </div>
                
            <div class="form-group">
                <label for="desc" class="col-sm-2 control-label">Описание</label>
                <div class="col-sm-10">
                    <textarea name="description" id="description" class="form-control" rows="3" required><?php echo ((is_array($_tmp=@$this->_tpl_vars['ad']->description)) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</textarea>
                </div>
            </div>
                
            <div class="form-group">
                <label for="price" class="col-sm-2 control-label">Цена</label>
                <div class="col-sm-10">
                    <input type="text" name="price" class="form-control" id="price" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['ad']->price)) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
" placeholder="Цена" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="<?php echo $this->_tpl_vars['button_name']; ?>
" value=<?php echo $this->_tpl_vars['button_value']; ?>
 class="btn btn-default"><?php echo $this->_tpl_vars['button_value']; ?>
</button>
                    <?php if ($this->_tpl_vars['button_name'] == 'edit'): ?> 
                        <input type="hidden" name="id" id="hiddenField" value="<?php echo $this->_tpl_vars['default_edit_id']; ?>
" />
                    <?php endif; ?>
                </div>
            </div>
        </form>

    </body>
</html>