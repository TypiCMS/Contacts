<?php
use TypiCMS\Modules\Contacts\Models\Contact;
use Illuminate\Support\Facades\Crypt;

class ContactsControllerTest extends TestCase
{

    public function testAdminIndex()
    {
        $response = $this->call('GET', 'admin/contacts');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStoreFails()
    {
        $input = array();
        $this->call('POST', 'admin/contacts', $input);
        $this->assertRedirectedToRoute('admin.contacts.create');
        $this->assertSessionHasErrors();
    }

    public function testStoreSuccess()
    {
        $object = new Contact;
        $object->id = 1;
        Contact::shouldReceive('create')->once()->andReturn($object);
        $input = array('title' => 'mr', 'first_name' => 'John', 'last_name' => 'Doe', 'email' => 'john@doe.com', 'message' => 'Hello', 'my_time' => Crypt::encrypt(time()-60));
        $this->call('POST', 'admin/contacts', $input);
        $this->assertRedirectedToRoute('admin.contacts.edit', array('id' => 1));
    }

    public function testStoreSuccessWithRedirectToList()
    {
        $object = new Contact;
        $object->id = 1;
        Contact::shouldReceive('create')->once()->andReturn($object);
        $input = array('title' => 'mr', 'first_name' => 'John', 'last_name' => 'Doe', 'email' => 'john@doe.com', 'message' => 'Hello', 'my_time' => Crypt::encrypt(time()-60), 'exit' => true);
        $this->call('POST', 'admin/contacts', $input);
        $this->assertRedirectedToRoute('admin.contacts.index');
    }

}
