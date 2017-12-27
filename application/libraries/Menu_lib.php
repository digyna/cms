<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Menu_lib
{
    private $activeClass = 'active';
    private $active_link = TRUE;
    protected $activeItem = '';
    protected $activeHref = '';
    private $arrHref = array();
    private $arrAttr = array();
    private $strAttr = array();
    private $result = array();

    public function __construct($config = array())
    {
        empty($config) OR $this->init($config,FALSE);
    }

    public function init($config = array(),$reset = TRUE){
        if ($reset === TRUE)
        {
            $this->activeClass = 'active';
            $this->activeItem = '';
            $this->active_link = TRUE;
            $this->arrHref = array();
            $this->arrAttr = array();
            $this->strAttr = array();
            $this->result = array();

        }

        if (isset($config['data']))
        {
            $this->setData($config['data']);
        }

        if (isset($config['ul-root']))
        {
            $this->set('ul-root', $config['ul-root']);
        }

        if (isset($config['ul']))
        {
            $this->set('ul', $config['ul']);
        }

        if (isset($config['li-parent']))
        {
            $this->set('li-parent', $config['li-parent']);
        }

        if (isset($config['a-parent']))
        {
            $this->set('a-parent', $config['a-parent']);
        }

        if (isset($config['active_link']))
        {
            $this->set_active_link($config['active_link']);
        }

    }

    /**
     * Set the attributes for the tag vars
     * @param string $name Var name
     * @param mixed $value Var value
     * Var names: 'ul', 'ul-root', 'li', 'li-parent', 'a', 'a-parent', 'active-class'
     */
    public function set($name, $value)
    {
        $tags = array('ul', 'ul-root', 'li', 'li-parent', 'a', 'a-parent', 'active-class');
        if (in_array($name, $tags))
        {
            $this->arrAttr[$name] = $value;
        }
    }

    /**
     * @param mixed $href (string or array)
     * @param string $activeClass (Optional) The Css class for the active item
     */
    public function setActiveItem($href, $activeClass = '')
    {
        if (is_string($href))
        {
            $this->activeItem = $href;
        } elseif (is_array($href))
        {
            $this->arrHref = $href;
        }
        
        if ($activeClass != '')
        {
            $this->activeClass = $activeClass;
        }
        $this->set('active-class', array('class' => $this->activeClass));
    }

    /**
     * @param string $href var name
     * @param string $activeClass (Optional) The Css class for the active item
     */
    public function set_active_link($status)
    {
        
            $this->active_link = $status;
    }
      
    /**
     * The Html menu
     * @return string Html menu
     */
    public function html($html='')
    {
        foreach ($this->arrAttr as $tag => $attr)
        {
            $this->strAttr[$tag] = $this->buildAttributes($tag);
        }
       
        $html=$this->buildFromResult($this->result);
       

        return $html;
    }

    /**
     * Build the menu from query database.
     * This is a alias (shorthand) for setResult() and html()
     * @param array $result The resultset
     * @param string $columnID The ID column name (Primary key)
     * @param string $columnParent The column name for identify the parent item
     */
    public function fromResult($result, $columnID, $columnParent)
    {
        $this->setResult($result, $columnID, $columnParent);
        return $this->buildFromResult($this->result);
    }

    /**
     * Set result from query database
     * @param array $result The resultset
     * @param string $columnID The ID column name (Primary key)
     * @param string $columnParent The column name for identify the parent item
     */
    public function setResult($result, $columnID, $columnParent,$isLink=TRUE)
    {
        $items = array();
        foreach ($result as $row)
        {
            if($isLink){
                $li_class = (isset($row->li_class)) ? $row->li_class : NULL;
                $badge = (isset($row->badge)) ? $row->badge : NULL;
                $target = (isset($row->target)) ? $row->target : '_self';
                $icon = (isset($row->icon)) ? $row->icon : NULL;
                $href = (isset($row->href)) ? $row->href : NULL;

                $items[$row->$columnParent][$row->$columnID] = array('href' => $href, 'text' => $row->text, 'icon' => $icon, 'target' => $target,'badge'=>$badge,'li_class' => $li_class);
                unset($b);
            }else{

                $class = (isset($row->class)) ? $row->class : NULL;
                $input = (isset($row->input)) ? $row->input : NULL;
                $items[$row->$columnParent][$row->$columnID] = array('class' => $class, 'input' => $input, 'text' => $row->text);
            }
            
        }
        $this->result = $items;
    }

    /**
     * @param string $tag
     * @return string Tag Attributes stored
     */
    protected function getAttr($tag)
    {
        $attr=isset($this->strAttr[$tag]) ? $this->strAttr[$tag] : '';

            if (isset($this->arrAttr[$tag]))
            {
                foreach ($this->arrAttr[$tag] as $name => $value)
                {
                    $attr .= " {$name}=\"{$value}\"";
                }
            }
        
        return $attr;
    }

    /**
     * @param array $item The Item menu
     * @param boolean $isParent This item is parent?
     * @return string The Html code
     */
    protected function getTextItem($item, $isParent)
    {
        $str = (isset($item['icon'])) ? "<i class=\"material-icons\">{$item['icon']}</i>" : '';
        
            if(isset($item['input'])){
                $type = (isset($item['input']['type'])) ? "type=\"{$item['input']['type']}\" " : '';
                $name = (isset($item['input']['name'])) ? "name=\"{$item['input']['name']}\" " : '';
                $value = (isset($item['input']['value'])) ? "value=\"{$item['input']['value']}\" " : '';
                $class = (isset($item['input']['class'])) ? "class=\"{$item['input']['class']}\" " : '';
                $checked = (isset($item['input']['checked'])) ? $item['input']['checked'] : FALSE;
                $checked = ($checked==TRUE) ? 'checked' : NULL;

                $str .= "<input {$type}{$name}{$value}{$class}{$checked}/> ";
            }
        $str .= "<span class=\"text\">{$item['text']}</span> ";
        $str .= (isset($item['small'])) ? "<span class=\"small\">{$item['small']}</span> " : '';
        $str .= (isset($item['badge'])) ? "<span class=\"badge bg-red\">{$item['badge']}</span> " : '';
        return $str;
    }

    /**
     * Renderize the tag attributes from array
     * @param string $tag The tag
     * @return string The string atributes
     */
    private function buildAttributes($tag)
    {
        $str = '';
        if (isset($this->arrAttr[$tag]))
        {
            foreach ($this->arrAttr[$tag] as $name => $value)
            {
                $str .= " {$name}=\"{$value}\"";
            }
        }
        return $str;
    }

    /**
     * Build the menu from a prepared array of Query Result
     * @param array $array Array de items
     * @param string $parent Parent ID
     * @param int $level Nivel del item
     */
    protected function buildFromResult(array $array, $parent = '0', $level = 0)
    {
        $ul = ($parent === '0') ? 'ul-root' : 'ul';
        $str = '<ul' . $this->getAttr($ul) . '>';
        foreach ($array[$parent] as $item_id => $item)
        {
            $isParent = isset($array[$item_id]);
            $li = ($isParent) ? 'li-parent' : 'li';
            $isLink = isset($item['href']);
            $a = ($isParent) ? 'a-parent' : 'a';
            $attr=$this->getAttr($li);
            if ($isLink)
            {

                $active ='';

                if (!empty($this->arrHref)){
                    foreach ($this->arrHref as $segment){
                        if($segment == $item['href']){
                            $active = ($this->activeHref == $item['href']) ? '' : $this->getAttr('active-class');
                            break;
                        }
                    }
                }else{
                    $active = ($this->activeItem == $item['href']) ? $this->getAttr('active-class') : '';
                }

                    $str .= '<li ' . $attr . " {$active} >";

                    if($isParent){
                        $str .= '<a href="javascript:void(0);"' . $this->getAttr($a) . '>' . $this->getTextItem($item, $isParent) . '</a>';
                    }else{
                        if(empty($active)){
                           $str .= '<a href="' . $item['href'] . '"' . $this->getAttr($a) . '>' . $this->getTextItem($item, $isParent) . '</a>'; 
                       }else{
                        if($this->active_link){
                            $str .= '<a href="' . $item['href'] . '"' . $this->getAttr($a) . '>' . $this->getTextItem($item, $isParent) . '</a>';
                        }else{
                            $str .= $this->getTextItem($item, $isParent);
                        }
                       }

                        
                    }
            }else{
                $str .= (isset($item['li_class'])) ? '<li class="'.$item['li_class'].'" >' : '<li> ';
                $str .= $this->getTextItem($item, $isParent);
                
            }

            if ($isParent)
            {
                $str .= $this->buildFromResult($array, $item_id, $level + 2);
            }
            $str .= '</li> ';
        }
        $str .= '</ul>';
        return $str;
    }


}
