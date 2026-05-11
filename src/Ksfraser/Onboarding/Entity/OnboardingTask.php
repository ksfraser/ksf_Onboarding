<?php

declare(strict_types=1);

namespace Ksfraser\Onboarding\Entity;

class OnboardingTask
{
    public const STATUS_PENDING = 'pending';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_SKIPPED = 'skipped';

    private ?int $id = null;
    private int $employeeId = 0;
    private int $onboardingId = 0;
    private string $title = '';
    private string $description = '';
    private string $category = 'General';
    private int $sortOrder = 0;
    private string $status = self::STATUS_PENDING;
    private ?int $assignedTo = null;
    private ?string $dueDate = null;
    private ?string $completedAt = null;

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): self { $this->id = $id; return $this; }
    public function getEmployeeId(): int { return $this->employeeId; }
    public function setEmployeeId(int $employeeId): self { $this->employeeId = $employeeId; return $this; }
    public function getOnboardingId(): int { return $this->onboardingId; }
    public function setOnboardingId(int $onboardingId): self { $this->onboardingId = $onboardingId; return $this; }
    public function getTitle(): string { return $this->title; }
    public function setTitle(string $title): self { $this->title = $title; return $this; }
    public function getDescription(): string { return $this->description; }
    public function setDescription(string $description): self { $this->description = $description; return $this; }
    public function getCategory(): string { return $this->category; }
    public function setCategory(string $category): self { $this->category = $category; return $this; }
    public function getSortOrder(): int { return $this->sortOrder; }
    public function setSortOrder(int $sortOrder): self { $this->sortOrder = $sortOrder; return $this; }
    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): self { $this->status = $status; return $this; }
    public function getAssignedTo(): ?int { return $this->assignedTo; }
    public function setAssignedTo(?int $assignedTo): self { $this->assignedTo = $assignedTo; return $this; }
    public function getDueDate(): ?string { return $this->dueDate; }
    public function setDueDate(?string $dueDate): self { $this->dueDate = $dueDate; return $this; }
    public function getCompletedAt(): ?string { return $this->completedAt; }
    public function setCompletedAt(?string $completedAt): self { $this->completedAt = $completedAt; return $this; }
    public function isCompleted(): bool { return $this->status === self::STATUS_COMPLETED; }
}