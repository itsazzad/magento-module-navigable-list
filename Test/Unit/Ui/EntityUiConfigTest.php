<?php

declare(strict_types=1);

namespace Harriswebworks\Sizing\Test\Unit\Ui;

use Harriswebworks\Sizing\Ui\EntityUiConfig;
use PHPUnit\Framework\TestCase;

class EntityUiConfigTest extends TestCase
{
    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testConstruct()
    {
        $this->expectException(\InvalidArgumentException::class);
        new EntityUiConfig('Name\Too\Short');
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testConstructWrongName()
    {
        $this->expectException(\InvalidArgumentException::class);
        new EntityUiConfig('Name\Does\Not\End\With\Proper\Termination');
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getInterface
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetInterface()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $this->assertEquals('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface', $uiConfig->getInterface());
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getBackLabel
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetBackLabel()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $this->assertEquals('Back', $uiConfig->getBackLabel());
        $uiConfig = new EntityUiConfig(
            'SomeNamespace\SomeModule\Api\Data\SomeEntityInterface',
            ['labels' => ['back' => 'Back to list']]
        );
        $this->assertEquals('Back to list', $uiConfig->getBackLabel());
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getSaveLabel
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetSaveLabel()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $this->assertEquals('Save', $uiConfig->getSaveLabel());
        $uiConfig = new EntityUiConfig(
            'SomeNamespace\SomeModule\Api\Data\SomeEntityInterface',
            ['labels' => ['save' => 'Save Entity']]
        );
        $this->assertEquals('Save Entity', $uiConfig->getSaveLabel());
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getSaveAndDuplicateLabel
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetSaveAndDuplicateLabel()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $this->assertEquals('Save & Duplicate', $uiConfig->getSaveAndDuplicateLabel());
        $uiConfig = new EntityUiConfig(
            'SomeNamespace\SomeModule\Api\Data\SomeEntityInterface',
            ['labels' => ['save_and_duplicate' => 'Save And clone it']]
        );
        $this->assertEquals('Save And clone it', $uiConfig->getSaveAndDuplicateLabel());
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getSaveAndCloseLabel
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetSaveAndCloseLabel()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $this->assertEquals('Save & close', $uiConfig->getSaveAndCloseLabel());
        $uiConfig = new EntityUiConfig(
            'SomeNamespace\SomeModule\Api\Data\SomeEntityInterface',
            ['labels' => ['save_and_close' => 'Save And go to list']]
        );
        $this->assertEquals('Save And go to list', $uiConfig->getSaveAndCloseLabel());
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getAllowSaveAndClose
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetAllowSaveAndClose()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $this->assertTrue($uiConfig->getAllowSaveAndClose());
        $uiConfig = new EntityUiConfig(
            'SomeNamespace\SomeModule\Api\Data\SomeEntityInterface',
            ['save' => ['allow_close' => false]]
        );
        $this->assertFalse($uiConfig->getAllowSaveAndClose());
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getAllowSaveAndDuplicate
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetAllowSaveAndDuplicate()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $this->assertTrue($uiConfig->getAllowSaveAndDuplicate());
        $uiConfig = new EntityUiConfig(
            'SomeNamespace\SomeModule\Api\Data\SomeEntityInterface',
            ['save' => ['allow_duplicate' => false]]
        );
        $this->assertFalse($uiConfig->getAllowSaveAndDuplicate());
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getSaveFormTarget
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetSaveFormTarget()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $expected = 'somemodule_some_entity_form.somemodule_some_entity_form';
        $this->assertEquals($expected, $uiConfig->getSaveFormTarget());
        $uiConfig = new EntityUiConfig(
            'SomeNamespace\SomeModule\Api\Data\SomeEntityInterface',
            ['save_form_target' => 'save_form_target']
        );
        $this->assertEquals('save_form_target', $uiConfig->getSaveFormTarget());
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getDeleteLabel
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetDeleteLabel()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $this->assertEquals('Delete', $uiConfig->getDeleteLabel());
        $uiConfig = new EntityUiConfig(
            'SomeNamespace\SomeModule\Api\Data\SomeEntityInterface',
            ['labels' => ['delete' => 'Delete entity']]
        );
        $this->assertEquals('Delete entity', $uiConfig->getDeleteLabel());
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getDeleteMessage
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetDeleteMessage()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $this->assertEquals('Are you sure you want to delete the item?', $uiConfig->getDeleteMessage());
        $uiConfig = new EntityUiConfig(
            'SomeNamespace\SomeModule\Api\Data\SomeEntityInterface',
            ['labels' => ['delete_message' => 'Really?']]
        );
        $this->assertEquals('Really?', $uiConfig->getDeleteMessage());
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getDeletePopupTitle
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetDeletePopupTitle()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $this->assertEquals('Delete "${ $.$data.title }"', $uiConfig->getDeletePopupTitle());
        $uiConfig = new EntityUiConfig(
            'SomeNamespace\SomeModule\Api\Data\SomeEntityInterface',
            ['labels' => ['delete_title' => 'Confirm Delete "${ $.$data.%1 }"'], 'name_attribute' => 'name']
        );
        $this->assertEquals('Confirm Delete "${ $.$data.name }"', $uiConfig->getDeletePopupTitle());
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getRequestParamName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetRequestParamName()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $this->assertEquals('some_entity_id', $uiConfig->getRequestParamName());
        $uiConfig = new EntityUiConfig(
            'SomeNamespace\SomeModule\Api\Data\SomeEntityInterface',
            ['request_param' => 'request_param']
        );
        $this->assertEquals('request_param', $uiConfig->getRequestParamName());
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getListPageTitle
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetListPageTitle()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $this->assertEquals('Some Entity', $uiConfig->getListPageTitle());
        $uiConfig = new EntityUiConfig(
            'SomeNamespace\SomeModule\Api\Data\SomeEntityInterface',
            ['list' => ['page_title' => 'Page Title']]
        );
        $this->assertEquals('Page Title', $uiConfig->getListPageTitle());
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getMenuItem
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetMenuItem()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $this->assertEquals('SomeNamespace_SomeModule::somemodule_some_entity', $uiConfig->getMenuItem());
        $uiConfig = new EntityUiConfig(
            'SomeNamespace\SomeModule\Api\Data\SomeEntityInterface',
            ['menu' => 'Menu_Item']
        );
        $this->assertEquals('Menu_Item', $uiConfig->getMenuItem());
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getDeleteSuccessMessage
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetDeleteSuccessMessage()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $this->assertEquals('Item was deleted successfully', $uiConfig->getDeleteSuccessMessage());
        $uiConfig = new EntityUiConfig(
            'SomeNamespace\SomeModule\Api\Data\SomeEntityInterface',
            ['messages' => ['delete' => ['success' => 'Successful delete']]]
        );
        $this->assertEquals('Successful delete', $uiConfig->getDeleteSuccessMessage());
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getDeleteMissingEntityMessage
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetDeleteMissingEntityMessage()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $this->assertEquals('Item for delete was not found', $uiConfig->getDeleteMissingEntityMessage());
        $uiConfig = new EntityUiConfig(
            'SomeNamespace\SomeModule\Api\Data\SomeEntityInterface',
            ['messages' => ['delete' => ['missing_entity' => 'Missing entity to delete']]]
        );
        $this->assertEquals('Missing entity to delete', $uiConfig->getDeleteMissingEntityMessage());
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getGeneralDeleteErrorMessage
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetGeneralDeleteErrorMessage()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $this->assertEquals('There was a problem deleting the item.', $uiConfig->getGeneralDeleteErrorMessage());
        $uiConfig = new EntityUiConfig(
            'SomeNamespace\SomeModule\Api\Data\SomeEntityInterface',
            ['messages' => ['delete' => ['error' => 'Something Happened']]]
        );
        $this->assertEquals('Something Happened', $uiConfig->getGeneralDeleteErrorMessage());
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getSaveSuccessMessage
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetSaveSuccessMessage()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $this->assertEquals('Item was saved successfully.', $uiConfig->getSaveSuccessMessage());
        $uiConfig = new EntityUiConfig(
            'SomeNamespace\SomeModule\Api\Data\SomeEntityInterface',
            ['messages' => ['save' => ['success' => 'Save success']]]
        );
        $this->assertEquals('Save success', $uiConfig->getSaveSuccessMessage());
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getSaveErrorMessage
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetSaveErrorMessage()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $this->assertEquals('There was a problem saving the item.', $uiConfig->getSaveErrorMessage());
        $uiConfig = new EntityUiConfig(
            'SomeNamespace\SomeModule\Api\Data\SomeEntityInterface',
            ['messages' => ['save' => ['error' => 'Save error']]]
        );
        $this->assertEquals('Save error', $uiConfig->getSaveErrorMessage());
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getDuplicateSuccessMessage
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetDuplicateSuccessMessage()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $this->assertEquals('Item was duplicated successfully.', $uiConfig->getDuplicateSuccessMessage());
        $uiConfig = new EntityUiConfig(
            'SomeNamespace\SomeModule\Api\Data\SomeEntityInterface',
            ['messages' => ['save' => ['duplicate' => 'Duplication success']]]
        );
        $this->assertEquals('Duplication success', $uiConfig->getDuplicateSuccessMessage());
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getMassDeleteSuccessMessage
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetMassDeleteSuccessMessage()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $this->assertEquals('5 items were successfully deleted', $uiConfig->getMassDeleteSuccessMessage(5));
        $uiConfig = new EntityUiConfig(
            'SomeNamespace\SomeModule\Api\Data\SomeEntityInterface',
            ['messages' => ['mass_delete' => ['success' => '%1 items deleted']]]
        );
        $this->assertEquals('5 items deleted', $uiConfig->getMassDeleteSuccessMessage(5));
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getMassDeleteErrorMessage
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetMassDeleteErrorMessage()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $this->assertEquals('There was a problem deleting the items', $uiConfig->getMassDeleteErrorMessage());
        $uiConfig = new EntityUiConfig(
            'SomeNamespace\SomeModule\Api\Data\SomeEntityInterface',
            ['messages' => ['mass_delete' => ['error' => 'Mass delete error']]]
        );
        $this->assertEquals('Mass delete error', $uiConfig->getMassDeleteErrorMessage());
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getNewLabel
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetNewLabel()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $this->assertEquals('Add new item', $uiConfig->getNewLabel());
        $uiConfig = new EntityUiConfig(
            'SomeNamespace\SomeModule\Api\Data\SomeEntityInterface',
            ['labels' => ['new' => 'Add new']]
        );
        $this->assertEquals('Add new', $uiConfig->getNewLabel());
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getNameAttribute
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetNameAttribute()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $this->assertEquals('title', $uiConfig->getNameAttribute());
        $uiConfig = new EntityUiConfig(
            'SomeNamespace\SomeModule\Api\Data\SomeEntityInterface',
            ['name_attribute' => 'name']
        );
        $this->assertEquals('name', $uiConfig->getNameAttribute());
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getPersistoryKey
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetPersistoryKey()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $this->assertEquals('some_entity', $uiConfig->getPersistoryKey());
        $uiConfig = new EntityUiConfig(
            'SomeNamespace\SomeModule\Api\Data\SomeEntityInterface',
            ['persistor_key' => 'persistor']
        );
        $this->assertEquals('persistor', $uiConfig->getPersistoryKey());
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getEditUrlPath
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetEditUrlPath()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $this->assertEquals('somemodule/someentity/edit', $uiConfig->getEditUrlPath());
        $uiConfig = new EntityUiConfig(
            'SomeNamespace\SomeModule\Api\Data\SomeEntityInterface',
            ['edit_url' => 'edit_url']
        );
        $this->assertEquals('edit_url', $uiConfig->getEditUrlPath());
    }

    /**
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::getDeleteUrlPath
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::parseInterfaceName
     * @covers \Harriswebworks\Sizing\Ui\EntityUiConfig::__construct
     */
    public function testGetDeleteUrlPath()
    {
        $uiConfig = new EntityUiConfig('SomeNamespace\SomeModule\Api\Data\SomeEntityInterface');
        $this->assertEquals('somemodule/someentity/delete', $uiConfig->getDeleteUrlPath());
        $uiConfig = new EntityUiConfig(
            'SomeNamespace\SomeModule\Api\Data\SomeEntityInterface',
            ['delete_url' => 'delete_url']
        );
        $this->assertEquals('delete_url', $uiConfig->getDeleteUrlPath());
    }
}
