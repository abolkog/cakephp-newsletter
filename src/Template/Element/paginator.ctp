<ul class="pagination pagination-sm no-margin">
    <li><?php echo $this->Paginator->prev('«', array('tag'=>false,'escape'=>false), '«', array('tag'=>'a','escape'=>false, 'class' => 'prev disabled'));?></li>
    <li><?php echo $this->Paginator->numbers(array('tag'=>false,'currentTag'=>'a','separator' => ''));?></li>
    <li><?php echo $this->Paginator->next('»', array('tag'=>false,'escape'=>false), '»', array('tag'=>'a','escape'=>false, 'class' => 'next disabled'));?></li>
</ul>