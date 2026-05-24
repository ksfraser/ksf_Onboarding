# Functional Requirements - ksf_Onboarding

## Document Information
- **Module**: ksf_Onboarding
- **Version**: 1.0.0
- **Date**: 2026-05-24
- **Status**: Draft
- **Author**: KSFII Development Team

---

## 1. Onboarding Plan Management

### FR-ONB-001: Create Onboarding Plan
**Description**: HR admin can create an onboarding plan for a new employee.

| Field | Type | Required | Notes |
|-------|------|----------|-------|
| employee_id | string | Yes | FK to crm_persons |
| start_date | date | Yes | First day of employment |
| buddy_id | string | No | Assigned onboarding buddy |
| department_id | string | No | Target department |

### FR-ONB-002: Manage Onboarding Plan
**Description**: HR admin can update plan details, assign/change buddy, and mark plan as abandoned or completed.

### FR-ONB-003: View Onboarding Status
**Description**: Managers and HR can view the status of all onboarding plans in their team/department. Employees can view their own plan status.

---

## 2. Task Checklist

### FR-ONB-004: Task Management
**Description**: HR admin can create, update, and delete onboarding tasks within a plan.

| Field | Type | Required | Notes |
|-------|------|----------|-------|
| name | string | Yes | Task name |
| description | text | No | Detailed instructions |
| assigned_to | string | No | Department or person responsible |
| is_required | boolean | Yes | Whether task is mandatory |
| due_date | date | No | Relative to start_date |

### FR-ONB-005: Task Completion
**Description**: Assigned parties can mark tasks as completed, in_progress, or waived. Completed tasks record the completing user and timestamp.

---

## 3. Document Collection

### FR-ONB-006: Document Upload
**Description**: Employee can upload required documents (contract, ID, tax forms, etc.) to their onboarding plan.

### FR-ONB-007: Document Verification
**Description**: HR admin can verify received documents, mark them as approved or rejected, and request re-upload if needed.

---

## 4. Probation Tracking

### FR-ONB-008: Probation Period Setup
**Description**: HR admin can configure probation period length (default 3 months) linked to the onboarding plan.

### FR-ONB-009: Probation Review Triggers
**Description**: System sends notifications at probation mid-point and end-date for review scheduling.

---

## 5. RBAC Integration

### FR-ONB-010: Role-Based Access
**Description**: Access to onboarding plans and tasks is controlled via ksfraser/rbac with the following roles:

| Role | Access Level | Scope |
|------|-------------|-------|
| HR Admin | FULL | All onboarding plans |
| Manager | PUBLIC + task completion | Direct reports |
| Onboarding Buddy | PUBLIC | Assigned plans |
| Employee | PUBLIC | Own plan |
| IT/Facilities | PUBLIC | Assigned tasks |

### FR-ONB-011: Data Projections
**Description**: The module enforces PUBLIC vs FULL projections per the RBAC entity projection table defined in Architecture.md §3.2.

### FR-ONB-012: Record Visibility
**Description**: Onboarding plans are visible via the standard RBAC JOIN pattern. Deleted/abandoned plans are excluded from default queries.

---

*Document Version: 1.0.0*
*Last Updated: 2026-05-24*
