<?php

declare(strict_types=1);

namespace Ksfraser\Tests\Unit\Onboarding\Entity;

use Ksfraser\Onboarding\Entity\OnboardingPlan;
use PHPUnit\Framework\TestCase;

class OnboardingPlanTest extends TestCase
{
    public function testDefaultValues(): void
    {
        $plan = new OnboardingPlan();

        $this->assertNull($plan->getId());
        $this->assertSame(0, $plan->getEmployeeId());
        $this->assertSame('', $plan->getTitle());
        $this->assertSame('draft', $plan->getStatus());
    }

    /**
     * @covers Ksfraser\Onboarding\Entity\OnboardingPlan::__construct
     */
    public function testConstructWithData(): void
    {
        $plan = new OnboardingPlan([
            'id' => 1,
            'employee_id' => 100,
            'title' => 'New Hire Plan',
            'department' => 'Engineering',
        ]);

        $this->assertSame(1, $plan->getId());
        $this->assertSame(100, $plan->getEmployeeId());
        $this->assertSame('New Hire Plan', $plan->getTitle());
    }

    /**
     * @covers Ksfraser\Onboarding\Entity\OnboardingPlan::isCompleted
     */
    public function testIsCompleted(): void
    {
        $plan = new OnboardingPlan(['status' => 'active']);
        $this->assertFalse($plan->isCompleted());

        $plan->setStatus('completed');
        $this->assertTrue($plan->isCompleted());
    }
}