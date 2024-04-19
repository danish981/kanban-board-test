import { defineStore } from 'pinia'

export const useKanbanStore = defineStore('kanban', {
    state: () => {
        return {
            hoveredName: 'nothing',
            selectedTask: null,
            phases: [],
            users: [],
            creatingTask: false,
            creatingTaskProps: {
                id: null,
                name: '',
                phase_id: null,
                user_id: null,
            },
            updatingTaskProps: {
                id: null,
                name: '',
                phase_id: null,
                user_id: null,
            },
            self: null,
        }
    },
    actions: {
        unhoverTask() {
            this.hoveredName = 'nothing'
        },
        selectTask(task) {
            this.selectedTask = task
        },
        unselectTask(task) {
            this.selectedTask = null
        },
        hasSelectedTask() {
            return this.selectedTask !== null
        },

        // updatePhaseCompletionStatus(phaseId, isCompletionPhase) {
        //     const phaseIndex = this.phases.findIndex(phase => phase.id === phaseId);
        //     if (phaseIndex !== -1) {
        //         this.phases[phaseIndex].is_completion_phase = isCompletionPhase;
        //     }
        // },
    },
})
