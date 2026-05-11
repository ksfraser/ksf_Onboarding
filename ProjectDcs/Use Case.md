# Use Cases - ksf_Onboarding

## UC-OB-001: Start Onboarding
**Actor**: HR Manager, System

**Trigger**: New employee hired (from ksf_Recruitment)

**Flow**:
1. System creates onboarding checklist:
   - IT setup tasks
   - HR paperwork
   - Training schedule
   - Team introduction
2. Assign tasks to:
   - HR (paperwork)
   - IT (equipment, accounts)
   - Manager (introduction meetings)
   - New employee (forms)
3. New employee sees portal with tasks
4. Progress tracked

## UC-OB-002: Complete Onboarding Task
**Actor**: Assigned User

**Flow**:
1. User sees assigned task
2. Completes task
3. Marks complete
4. System:
   - Updates progress
   - Notifies next assignee
   - Alerts HR if overdue

## UC-OB-003: Onboarding Completion
**Actor**: System, HR Manager

**Trigger**: All tasks complete

**Flow**:
1. System detects completion
2. Employee marked as 'Active'
3. Org chart updated (ksf_OrgChart)
4. Team membership activated (ksf_Teams)
5. Offboarding checklist created (future)

*Document Version: 1.0.0*
*Last Updated: 2026-05-11*