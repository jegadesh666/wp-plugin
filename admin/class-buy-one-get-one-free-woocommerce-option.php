<?php

class Buy_One_Get_One_Free_Woocommerce_Option{

    public $plugin_name;

    private $settings = array();

    private $active_tab;

    private $this_tab = 'default';

    private $tab_name = "Basic setting";

    private $setting_key = 'pisol_bogo_basic';
    
    

    function __construct($plugin_name){
        $this->plugin_name = $plugin_name;

        $this->free_product = $this->getSavedProductArray();

        $this->settings = array(
           
            array('field'=>'title', 'class'=> 'bg-primary text-light', 'class_title'=>'text-light font-weight-light h4', 'label'=>__("Buy (number) Get (number) Free",'buy-one-get-one-free-woocommerce'), 'type'=>"setting_category"),
            array('field'=>'pisol_global_disable', 'label'=>__('Disable BOGO','buy-one-get-one-free-woocommerce'),'type'=>'switch', 'default'=>0,   'desc'=>__('Disable BOGO rule globally','buy-one-get-one-free-woocommerce')),
            array('field'=>'pisol_product_quantity', 'label'=>__('Quantity of product to buy','buy-one-get-one-free-woocommerce'),'type'=>'number', 'default'=>1, 'min'=>1, 'step'=>1,   'desc'=>__('Buy (number) quantity of product to get (number) quantity free','buy-one-get-one-free-woocommerce')),
            array('field'=>'pisol_free_product_quantity', 'label'=>__('Quantity of product given free','buy-one-get-one-free-woocommerce'),'type'=>'number', 'default'=>1, 'min'=>1, 'step'=>1,   'desc'=>__('How much quantity of the product will be given free','buy-one-get-one-free-woocommerce')),
            
            array('field'=>'pisol_free_product', 'label'=>__('Product given for free','buy-one-get-one-free-woocommerce'),'type'=>'select', 'default'=>"",   'desc'=>__('If left blank same product will be given free in bogo offer, (You can only select simple product)','buy-one-get-one-free-woocommerce'), 'value'=>$this->free_product),

           

        );
        
        $this->tab = filter_input( INPUT_GET, 'tab', FILTER_SANITIZE_STRING );
        $this->active_tab = $this->tab != "" ? $this->tab : 'default';

        if($this->this_tab == $this->active_tab){
            add_action($this->plugin_name.'_tab_content', array($this,'tab_content'));
        }


        add_action($this->plugin_name.'_tab', array($this,'tab'),1);

       
        $this->register_settings();

        if(CUSTOM_BOGO_DELETE_SETTING){
            $this->delete_settings();
        }
    }

    function getSavedProductArray(){
        $free_product_id = get_option('pisol_free_product',"");
        if( empty($free_product_id )) return array();

        $product_title = get_the_title($free_product_id);
        $product = array( $free_product_id => $product_title );
        return $product;
    }

    
    function delete_settings(){
        foreach($this->settings as $setting){
            delete_option( $setting['field'] );
        }
    }

    function register_settings(){   

        foreach($this->settings as $setting){
            register_setting( $this->setting_key, $setting['field']);
        }
    
    }

    function tab(){
        $page = filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING );
        ?>
        <a class=" px-3 text-light d-flex align-items-center  border-left border-right  <?php echo ($this->active_tab == $this->this_tab ? 'bg-primary' : 'bg-secondary'); ?>" href="<?php echo admin_url( 'admin.php?page='.$page.'&tab='.$this->this_tab ); ?>">
            <?php _e( $this->tab_name); ?> 
        </a>
        <?php
    }

    function tab_content(){
        
       ?>
        <form method="post" action="options.php"  class="pisol-setting-form">
        <?php settings_fields( $this->setting_key ); ?>
        <?php
            foreach($this->settings as $setting){
                new pisol_class_form_sn($setting, $this->setting_key);
            }
        ?>
        <input type="submit" class="mt-3 mb-3 btn btn-primary btn-md" value="Save Option" />
        
        </form>
       <?php
    }

    
}

new Buy_One_Get_One_Free_Woocommerce_Option($this->plugin_name);