<?php
class Client_Model extends Model {
    public function __construct() {
        parent::__construct();
    }
    public function form($type='add',$id='null') {
        $action=($type=='add')?URL.'client/create':URL.'client/edit/'.$id;
        if ($type=='edit')
           $project=$this->getClient($id);
        $form = new Zebra_Form('addProject','POST',$action);

        $form->add('label', 'label_company', 'company', 'Company');
        $form->add('text', 'company', $project['company'], array('autocomplete' => 'off'));
        
        $form->add('label', 'label_name', 'name', 'Nombre');
        $form->add('text', 'contact', $project['contact'], array('autocomplete' => 'off'));
        
        $form->add('label', 'label_mail', 'mail', 'e-Mail');
        $form->add('text', 'mail', $project['mail'], array('autocomplete' => 'off'));
        
        $form->add('label', 'label_tel', 'tel', 'Telefono');
        $form->add('text', 'tel', $project['tel'], array('autocomplete' => 'off'));
        
        $form->add('label', 'label_address', 'address', 'Dirección');
        $form->add('text', 'address', $project['address'], array('autocomplete' => 'off'));
        
        $form->add('submit', 'btnsubmit', 'Submit');
        $form->validate();
        return $form;
    }
    
    public function getList() {
        $lista=$this->db->select("SELECT * FROM client");
        $b[0]=array(
           array(
               "title"  =>"Id",
               "width"  =>"5%"
           ),array(
               "title"  =>"Company",
               "width"  =>"10%"
           ),array(
               "title"  =>"Nombre",
               "width"  =>"20%"
           ),array(
               "title"  =>"Telefono",
               "width"  =>"20%"
           ),array(
               "title"  =>"e-Mail",
               "width"  =>"10%"
           ),array(
               "title"  =>"Options",
               "width"  =>"10%"
           ));
                     
        foreach($lista as $key => $value) {
            $b[]=
            array(
                "id"  =>$value['id'],
                "company"  =>$value['company'],
                "contact"  =>$value['contact'],
                "tel"  =>$value['tel'],
                "mail"  =>$value['mail'],
                "options"  =>'<a href="'.URL.'client/view/'.$value['id'].'"><div class="editTBtn"></div></a><a href="'.URL.'client/delete/'.$value['id'].'"><div class="deleteTBtn"></div></a>'
            );
        }
        return $b;
    }
    public function create() {
        $data = array(
            'company' => $_POST['company'],
            'contact'  => $_POST['contact'],
            'mail' => $_POST['mail'],
            'tel' => $_POST['tel'],
            'address' => $_POST['address'],
        );
        $page=$this->db->insert('client', $data);
    }
    public function edit($id){
        $data = array(
            'company' => $_POST['company'],
            'contact'  => $_POST['contact'],
            'mail' => $_POST['mail'],
            'tel' => $_POST['tel'],
            'address' => $_POST['address'],
        );
        $this->db->update('client', $data, 
            "`id` = '{$id}'");
    }
    public function delete($id){
         $this->db->delete('client', "`id` = {$id}");
         $this->delTree(UPLOAD.$id);
    }   
}