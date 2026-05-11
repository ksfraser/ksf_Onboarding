<?php

declare(strict_types=1);

namespace Ksfraser\Onboarding\Service;

use Ksfraser\Onboarding\Entity\OnboardingPlan;
use Ksfraser\Onboarding\Entity\OnboardingTask;

class OnboardingService
{
    private array $plans = [];
    private array $tasks = [];

    public function createPlan(array $data): OnboardingPlan
    {
        $plan = new OnboardingPlan($data);
        $this->plans[$plan->getId() ?? count($this->plans) + 1] = $plan;
        return $plan;
    }

    public function getPlan(int $id): ?OnboardingPlan
    {
        return $this->plans[$id] ?? null;
    }

    public function getEmployeePlans(int $employeeId): array
    {
        $plans = [];
        foreach ($this->plans as $plan) {
            if ($plan->getEmployeeId() === $employeeId) {
                $plans[] = $plan;
            }
        }
        return $plans;
    }

    public function addTask(array $data): OnboardingTask
    {
        $task = new OnboardingTask();
        if (isset($data['id'])) {
            $task->setId($data['id']);
        }
        $task->setEmployeeId($data['employee_id'] ?? 0);
        $task->setOnboardingId($data['onboarding_id'] ?? 0);
        $task->setTitle($data['title'] ?? '');
        $task->setDescription($data['description'] ?? '');
        $task->setCategory($data['category'] ?? 'General');
        $task->setSortOrder($data['sort_order'] ?? 0);

        $this->tasks[$task->getId() ?? count($this->tasks) + 1] = $task;
        return $task;
    }

    public function getTask(int $id): ?OnboardingTask
    {
        return $this->tasks[$id] ?? null;
    }

    public function updateTaskStatus(int $id, string $status): ?OnboardingTask
    {
        $task = $this->getTask($id);
        if ($task === null) return null;

        $task->setStatus($status);
        if ($status === OnboardingTask::STATUS_COMPLETED) {
            $task->setCompletedAt(date('Y-m-d H:i:s'));
        }
        $this->tasks[$id] = $task;
        return $task;
    }

    public function getProgress(int $onboardingId): float
    {
        $total = 0;
        $completed = 0;

        foreach ($this->tasks as $task) {
            if ($task->getOnboardingId() === $onboardingId) {
                $total++;
                if ($task->isCompleted()) {
                    $completed++;
                }
            }
        }

        return $total > 0 ? $completed / $total : 0;
    }
}