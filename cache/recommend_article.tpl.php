<?php /* Smarty version 2.6.26, created on 2015-07-02 14:17:57
         compiled from inc/recommend_article.tpl */ ?>
<?php if ($this->_tpl_vars['recommend_article']): ?>
<div class="incBox">
 <h3><a href="<?php echo $this->_tpl_vars['index']['article_link']; ?>
"><?php echo $this->_tpl_vars['lang']['article_news']; ?>
</a></h3>
 <ul class="recommendArticle">
  <?php $_from = $this->_tpl_vars['recommend_article']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['recommend_article'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['recommend_article']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['article']):
        $this->_foreach['recommend_article']['iteration']++;
?>
  <li<?php if (($this->_foreach['recommend_article']['iteration'] == $this->_foreach['recommend_article']['total'])): ?> class="last"<?php endif; ?>><b><?php echo $this->_tpl_vars['article']['add_time_short']; ?>
</b><a href="<?php echo $this->_tpl_vars['article']['url']; ?>
"><?php echo $this->_tpl_vars['article']['title']; ?>
</a></li>
  <?php endforeach; endif; unset($_from); ?>
 </ul>
</div>
<?php endif; ?>