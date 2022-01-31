<?php
declare(strict_types=1);
/** @noinspection DuplicatedCode */

namespace DEG\CustomReports\Test\Unit\Block\Adminhtml\CustomReport\Edit;

use DEG\CustomReports\Block\Adminhtml\CustomReport\Edit\DeleteButton;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\UrlInterface;
use PHPUnit\Framework\TestCase;

class DeleteButtonTest extends TestCase
{
    /**
     * @var DeleteButton
     */
    protected DeleteButton $deleteButton;

    /**
     * @var Context|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $context;

    /**
     * @var \Magento\Framework\UrlInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $url;

    /**
     * @var RequestInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $request;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->context = $this->createMock(Context::class);
        $this->url = $this->createMock(UrlInterface::class);
        $this->context->method('getUrlBuilder')->willReturn($this->url);

        $this->request = $this->createMock(RequestInterface::class);
        $this->context->method('getRequest')->willReturn($this->request);

        $this->deleteButton = new DeleteButton($this->context);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();
        unset($this->deleteButton);
        unset($this->url);
    }

    public function testGetButtonData(): void
    {
        $this->request->method('getParam')->with('customreport_id')->willReturn('1');
        $testUrl = 'https//local.local/123456';
        $this->url->method('getUrl')->willReturn($testUrl);

        $this->assertEquals([
            'label',
            'class',
            'on_click',
            'sort_order',
        ], array_keys($this->deleteButton->getButtonData()));
    }
}
