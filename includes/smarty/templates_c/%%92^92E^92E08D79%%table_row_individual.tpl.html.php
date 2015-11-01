<?php /* Smarty version 2.6.25-dev, created on 2015-10-31 10:39:06
         compiled from table_row_individual.tpl.html */ ?>
<tr id="<?php echo $this->_tpl_vars['ad_in_table']->getId(); ?>
">
    <td><?php echo $this->_tpl_vars['ad_in_table']->getTitle(); ?>
</td>
    <td><a class="btn btn-success btn-xs glyphicon glyphicon-search" title="Показать объявление"></a></td>
    <td><?php echo $this->_tpl_vars['ad_in_table']->getSellerName(); ?>
</td>
    <td><?php echo $this->_tpl_vars['ad_in_table']->getPrice(); ?>
</td>
    <td><a class="btn btn-danger btn-xs glyphicon glyphicon-remove" title="Удалить объявление"></a></td>
</tr>