<?php

declare(strict_types=1);

namespace Ksfraser\Onboarding\Entity;

class OnboardingTask
{
    public const STATUS_PENDING = 'Pending';
    public const STATUS_IN_PROGRESS = 'In Progress';
    public const STATUS_COMPLETED = 'Completed';
    public const STATUS_SKIPPED = 'Skipped';

    private ?int $id = null;
    private int $employeeId = 0;
    private int $templateTaskId = 0;
    private string $title = '';
    private string $description = '';
    private ?int $assignedTo = null;
    private string $dueDate = '';
    private string $status = self::STATUS_PENDING;
    private ?string $completedDate = null;
    private ?int $completedBy = null;
    private int $taskOrder = 0;

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): self { $this->id = $id; return $this; }
    public function getEmployeeId(): int { return $this->employeeId; }
    public function setEmployeeId(int $employeeId): self { $this->employeeId = $employeeId; return $this; }
    public function getTemplateTaskId(): int { return $this->templateTaskId; }
    public function setTemplateTaskId(int $templateTaskId): self { $this->templateTaskId = $templateTaskId; return $this; }
    public function getTitle(): string { return $this->title; }
    public function setTitle(string $title): self { $this->title = $title; return $this; }
    public function getDescription(): string { return $this->description; }
    public function setDescription(string $description): self { $this->description = $description; return $this; }
    public function getAssignedTo(): ?int { return $this->assignedTo; }
    public function setAssignedTo(?int $assignedTo): self { $this->assignedTo = $assignedTo; return $this; }
    public function getDueDate(): string { return $this->dueDate; }
    public function setDueDate(string $dueDate): self { $this->dueDate = $dueDate; return $this; }
    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): self { $this->status = $status; return $this; }
    public function getCompletedDate(): ?string { return $this->completedDate; }
    public function setCompletedDate(?string $completedDate): self { $this->completedDate = $completedDate; return $this; }
    public function getCompletedBy(): ?int { return $this->completedBy; }
    public function setCompletedBy(?int $completedBy): self { $this->completedBy = $completedBy; return $this; }
    public function getTaskOrder(): int { return $this->taskOrder; }
    public function setTaskOrder(int $taskOrder): self { $this->taskOrder = $taskOrder; return $this; }

    public function isCompleted(): bool { return $this->status === self::STATUS_COMPLETED; }
    public function isPending(): bool { return $this->status === self::STATUS_PENDING; }
    public function complete(int $completedBy): void { $this->status = self::STATUS_COMPLETED; $this->completedDate = date('Y-m-d'); $this->completedBy = $completedBy; }
}