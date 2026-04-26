<?php

declare(strict_types=1);

namespace Ksfraser\Onboarding\Tests\Unit\Entity;

use PHPUnit\Framework\TestCase;
use Ksfraser\Onboarding\Entity\OnboardingTask;

class OnboardingTaskTest extends TestCase
{
    public function testCanCreateTask(): void
    {
        $task = new OnboardingTask();
        $this->assertInstanceOf(OnboardingTask::class, $task);
    }

    public function testCanSetAndGetEmployeeId(): void
    {
        $task = new OnboardingTask();
        $task->setEmployeeId(1);
        $this->assertEquals(1, $task->getEmployeeId());
    }

    public function testCanCompleteTask(): void
    {
        $task = new OnboardingTask();
        $task->complete(5);
        $this->assertTrue($task->isCompleted());
        $this->assertEquals(5, $task->getCompletedBy());
    }
}