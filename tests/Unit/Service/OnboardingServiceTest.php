<?php

declare(strict_types=1);

namespace Ksfraser\Tests\Unit\Onboarding\Service;

use Ksfraser\Onboarding\Entity\OnboardingPlan;
use Ksfraser\Onboarding\Entity\OnboardingTask;
use Ksfraser\Onboarding\Service\OnboardingService;
use PHPUnit\Framework\TestCase;

class OnboardingServiceTest extends TestCase
{
    private OnboardingService $service;

    protected function setUp(): void
    {
        $this->service = new OnboardingService();
    }

    /**
     * @covers Ksfraser\Onboarding\Service\OnboardingService::createPlan
     */
    public function testCreatePlan(): void
    {
        $plan = $this->service->createPlan([
            'id' => 1,
            'employee_id' => 100,
            'title' => 'Engineering Onboarding',
        ]);

        $this->assertInstanceOf(OnboardingPlan::class, $plan);
        $this->assertSame('Engineering Onboarding', $plan->getTitle());
    }

    /**
     * @covers Ksfraser\Onboarding\Service\OnboardingService::addTask
     */
    public function testAddTask(): void
    {
        $task = $this->service->addTask([
            'id' => 1,
            'employee_id' => 100,
            'title' => 'Setup Laptop',
            'category' => 'IT',
        ]);

        $this->assertInstanceOf(OnboardingTask::class, $task);
        $this->assertSame('Setup Laptop', $task->getTitle());
    }

    /**
     * @covers Ksfraser\Onboarding\Service\OnboardingService::updateTaskStatus
     */
    public function testUpdateTaskStatus(): void
    {
        $this->service->addTask(['id' => 10, 'title' => 'T']);

        $updated = $this->service->updateTaskStatus(10, 'completed');

        $this->assertNotNull($updated);
        $this->assertSame('completed', $updated->getStatus());
    }

    /**
     * @covers Ksfraser\Onboarding\Service\OnboardingService::getProgress
     */
    public function testGetProgress(): void
    {
        $this->service->addTask(['id' => 20, 'onboarding_id' => 1, 'title' => 'T1']);
        $this->service->updateTaskStatus(20, 'completed');
        $this->service->addTask(['id' => 21, 'onboarding_id' => 1, 'title' => 'T2']);

        $progress = $this->service->getProgress(1);

        $this->assertSame(0.5, $progress);
    }
}