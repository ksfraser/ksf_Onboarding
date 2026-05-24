# Architecture - ksf_Onboarding

## Document Information
- **Module**: ksf_Onboarding
- **Version**: 1.0.0
- **Date**: 2026-05-24
- **Status**: Draft
- **Author**: KSFII Development Team

---

## 1. Module Overview

ksf_Onboarding manages the employee onboarding process including task checklists, document collection, orientation scheduling, and probation tracking.

### 1.1 Namespace
```php
Ksfraser\Onboarding\
```

### 1.2 Layer Pattern
```
ksf_Onboarding/              → Business Logic
    ├── Entity/              → Domain entities
    ├── Service/             → Business services
    ├── Repository/          → Data access interfaces
    └── Exception/           → Domain exceptions
```

---

## 2. Core Entities

### 2.1 OnboardingPlan
```php
class OnboardingPlan {
    private string $id;
    private string $employeeId;         // FK to HRM Employee or crm_persons
    private \DateTime $startDate;
    private OnboardingStatus $status;   // not_started, in_progress, completed, abandoned
    private ?string $buddyId;           // Assigned onboarding buddy
    private ?\DateTime $completedAt;
}
```

### 2.2 OnboardingTask
```php
class OnboardingTask {
    private string $id;
    private string $planId;
    private string $name;
    private string $description;
    private ?string $assignedTo;         // department/person responsible
    private bool $isRequired;
    private TaskStatus $status;          // pending, in_progress, completed, waived
    private ?\DateTime $dueDate;
    private ?\DateTime $completedAt;
    private ?string $completedById;
}
```

### 2.3 DocumentChecklist
```php
class DocumentChecklist {
    private string $id;
    private string $planId;
    private string $documentName;
    private bool $isReceived;
    private ?string $documentPath;
    private ?\DateTime $receivedAt;
}
```

---

## 3. RBAC Integration (ksfraser/rbac)

### 3.1 Module Registration

ksf_Onboarding registers with ksfraser/rbac:
- record_types: 'onboarding_plan', 'onboarding_task', 'document_checklist'
- projections: 'public' (plan status, task names/dates, document checklist status), 'full' (all fields including task assignments, buddy assignments, document paths)
- allow_invite: false
- children: onboarding_task, document_checklist (children of onboarding_plan)

### 3.2 Entity Projections

| Entity | PUBLIC Fields | FULL Fields |
|--------|---------------|-------------|
| OnboardingPlan | employee_id, status, start_date, completed_at | + buddy_id, department_id, notes, hr_notes |
| OnboardingTask | name, status, due_date, is_required | + assigned_to, completed_by_id, internal_instructions |
| DocumentChecklist | document_name, is_received | + document_path, received_by, verification_status |

### 3.3 Access Model

- **HR Admin**: FULL to all onboarding plans, can create/edit tasks (PROJECTION_FULL)
- **Manager**: View onboarding status of team members (PROJECTION_PUBLIC), complete tasks
- **Onboarding Buddy**: View assigned plans (PROJECTION_PUBLIC), mark tasks complete
- **Employee (onboardee)**: View own plan (PROJECTION_PUBLIC), upload documents
- **IT/Facilities**: View assigned tasks (PROJECTION_PUBLIC) for equipment provisioning

### 3.4 SQL Enforcement

Standard RBAC JOIN pattern against 0_rbac_record_access.

### 3.5 Soft Delete

- Onboarding plans use soft delete (abandoned → deleted=1)
- Completed plans are archived (status = completed, not deleted)
- Hard delete is super-admin only

---

*Document Version: 1.0.0*
*Last Updated: 2026-05-24*
