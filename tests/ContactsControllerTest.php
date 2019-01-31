<?php

use Illuminate\Support\Facades\Crypt;
use TypiCMS\Modules\Contacts\Models\Contact;

class ContactsControllerTest extends TestCase
{
    public function testAdminIndex()
    {
        $response = $this->call('GET', 'admin/contacts');
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testStoreFails()
    {
        $input = [];
        $this->call('POST', 'admin/contacts', $input);
        $this->assertRedirectedToRoute('admin.contacts.create');
        $this->assertSessionHasErrors();
    }

    public function testStoreSuccess()
    {
        $object = new Contact();
        $object->id = 1;
        Contact::shouldReceive('create')->once()->andReturn($object);
        $input = ['name' => 'John Doe', 'email' => 'john@doe.com', 'message' => 'Hello', 'my_time' => Crypt::encrypt(time() - 60)];
        $this->call('POST', 'admin/contacts', $input);
        $this->assertRedirectedToRoute('admin.contacts.edit', ['id' => 1]);
    }

    public function testStoreSuccessWithRedirectToList()
    {
        $object = new Contact();
        $object->id = 1;
        Contact::shouldReceive('create')->once()->andReturn($object);
        $input = ['name' => 'John Doe', 'email' => 'john@doe.com', 'message' => 'Hello', 'my_time' => Crypt::encrypt(time() - 60), 'exit' => true];
        $this->call('POST', 'admin/contacts', $input);
        $this->assertRedirectedToRoute('admin.contacts.index');
    }
}
