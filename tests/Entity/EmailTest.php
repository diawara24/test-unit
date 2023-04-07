<?php
namespace App\Tests\Entity;

use App\Service\EmailService;
use App\Service\Invoice;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EmailTest extends KernelTestCase {

    public function testEmailService() {
        $emailServiceMock = $this->createMock(EmailService::class);

        $emailServiceMock
        ->expects($this->once())
        ->method('send')
        ->willReturn(true);

        $invoiceService = new Invoice($emailServiceMock);

        $result = $invoiceService->process("test@test.org", 1200);
        
        $this->assertTrue($result);
    }
}