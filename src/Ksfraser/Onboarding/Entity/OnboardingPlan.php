<?php

declare(strict_types=1);

namespace Ksfraser\Onboarding\Entity;

class OnboardingPlan
{
    public const STATUS_DRAFT = 'draft';
    public const STATUS_ACTIVE = 'active';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    private ?int $id = null;
    private int $employeeId = 0;
    private string $title = '';
    private string $department = '';
    private string $manager = '';
    private string $startDate = '';
    private string $endDate = '';
    private string $status = self::STATUS_DRAFT;
    private array $tasks = [];
    private \DateTime $createdAt;

    public function __construct(array $data = [])
    {
        $this->id = $data['id'] ?? null;
        $this->employeeId = $data['employee_id'] ?? 0;
        $this->title = $data['title'] ?? '';
        $this->department = $data['department'] ?? '';
        $this->manager = $data['manager'] ?? '';
        $this->startDate = $data['start_date'] ?? '';
        $this->endDate = $data['end_date'] ?? '';
        $this->status = $data['status'] ?? self::STATUS_DRAFT;
        $this->tasks = $data['tasks'] ?? [];
        $this->createdAt = new \DateTime($data['created_at'] ?? 'now');
    }

    public function getId(): ?int { return $this->id; }
    public function getEmployeeId(): int { return $this->employeeId; }
    public function getTitle(): string { return $this->title; }
    public function setTitle(string $title): self { $this->title = $title; return $this; }
    public function getDepartment(): string { return $this->department; }
    public function setDepartment(string $department): self { $this->department = $department; return $this; }
    public function getManager(): string { return $this->manager; }
    public function setManager(string $manager): self { $this->manager = $manager; return $this; }
    public function getStartDate(): string { return $this->startDate; }
    public function getEndDate(): string { return $this->endDate; }
    public function getStatus(): string { return $this->status; }
    public function setStatus(string $status): self { $this->status = $status; return $this; }
    public function getTasks(): array { return $this->tasks; }
    public function getCreatedAt(): \DateTime { return $this->createdAt; }
    public function isCompleted(): bool { return $this->status === self::STATUS_COMPLETED; }
    public function getProgress(): float
    {
        if (empty($this->tasks)) return 0;
        $completed = count(array_filter($this->tasks, fn($t) => $t->isCompleted()));
        return $completed / count($this->tasks);
    }
}