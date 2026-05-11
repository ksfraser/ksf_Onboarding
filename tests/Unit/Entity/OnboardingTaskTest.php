<?php

declare(strict_types=1);

namespace Ksfraser\Tests\Unit\Onboarding\Entity;

use Ksfraser\Onboarding\Entity\OnboardingTask;
use PHPUnit\Framework\TestCase;

class OnboardingTaskTest extends TestCase
{
    public function testDefaultValues(): void
    {
        $task = new OnboardingTask();

        $this->assertNull($task->getId());
        $this->assertSame(0, $task->getEmployeeId());
        $this->assertSame('', $task->getTitle());
        $this->assertSame('General', $task->getCategory());
        $this->assertSame('pending', $task->getStatus());
        $this->assertFalse($task->isCompleted());
    }

    /**
     * @covers Ksfraser\Onboarding\Entity\OnboardingTask::setId
     */
    public function testSetId(): void
    {
        $task = new OnboardingTask();
        $result = $task->setId(1);

        $this->assertInstanceOf(OnboardingTask::class, $result);
        $this->assertSame(1, $task->getId());
    }

    /**
     * @covers Ksfraser\Onboarding\Entity\OnboardingTask::setTitle
     */
    public function testSetTitle(): void
    {
        $task = new OnboardingTask();
        $result = $task->setTitle('Setup Laptop');

        $this->assertInstanceOf(OnboardingTask::class, $result);
        $this->assertSame('Setup Laptop', $task->getTitle());
    }

    /**
     * @covers Ksfraser\Onboarding\Entity\OnboardingTask::isCompleted
     */
    public function testIsCompleted(): void
    {
        $task = new OnboardingTask();
        $task->setStatus(OnboardingTask::STATUS_PENDING);
        $this->assertFalse($task->isCompleted());

        $task->setStatus(OnboardingTask::STATUS_COMPLETED);
        $this->assertTrue($task->isCompleted());
    }
}