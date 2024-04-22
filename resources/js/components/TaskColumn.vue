<template>

  <div
    :id="props.phase_id"
    class="w-[300px] bg-sky-950 rounded-lg shadow-lg scrollable-div"

  >
    <div class="p-4">
      <div class="flex items-center justify-between">
        <h2 class="text-lg text-zinc-100 font-black mb-3">
          {{ kanban.phases[props.phase_id].name }}
        </h2>
        <TrashIcon
          v-if="kanban.phases[props.phase_id].name != 'Completed' "
          title="delete phase"
          @click="deletePhase"
          class="mb-3 h-6 w-6 text-white hover:cursor-pointer"
          aria-hidden="true"
        />
        <CheckIcon
          v-if="kanban.phases[props.phase_id].name != 'Completed' "
          title="mark as completion phase"
          @click="markAsCompletionPhase"
          class="mb-3 h-6 w-6 text-white hover:cursor-pointer"
          aria-hidden="true"
        />
        <PlusIcon
          @click="createTask"
          class="mb-3 h-6 w-6 text-white hover:cursor-pointer"
          aria-hidden="true"
        />
      </div>
      <task-card
        v-if="kanban.phases[props.phase_id].tasks.length > 0"
        v-for="task in kanban.phases[props.phase_id].tasks"
        :task="task"
        :key="task.id"
        :class="{ 'bg-green-200': task.is_completed }"
      />

      <div
        class="w-full flex items-center justify-between bg-white text-gray-900 hover:cursor-pointer shadow-md rounded-lg p-3 relative"
        @click="createTask"
      >
        <span>Create a new task</span>
        <PlusIcon class="h-6 w-6" aria-hidden="true" />
      </div>
    </div>
  </div>
</template>

<script setup>
import { useKanbanStore } from "../stores/kanban";
import { PlusIcon, CheckIcon, TrashIcon } from "@heroicons/vue/20/solid";
// import { refreshTasks } from '../components/KanbanBoard.vue';

import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

const kanban = useKanbanStore();

const props = defineProps({
  phase_id: {
    type: Number,
    required: true,
  },
});

const createTask = function () {
  kanban.creatingTask = true;
  kanban.creatingTaskProps.phase_id = props.phase_id;
};

const markAsCompletionPhase = async function () {
  try {
    const response = await axios.post("/api/phases/mark-as-completion", { phase_id: props.phase_id });

    kanban.phases[props.phase_id].is_completion_phase = true;
    kanban.phases[props.phase_id].tasks.forEach((task) => {
      task.is_completed = true;
    });

    toast.success(response.data.message);

    await refreshTasks();
  } catch (error) {
    console.error("There was an error marking the phase as completion phase:", error);
    toast.error(error.response.data.message);
  }
};

const deletePhase = async function () {
  try {
    const response = await axios.delete("/api/phases/" + props.phase_id);
    toast.success(response.data.message);
    await refreshTasks();
  } catch (error) {
    console.error("There was an error deleting the phase!", error);
    toast.error(error.response.data.message);
  }
};

// method copied from kanban board
const refreshTasks = async () => {
  try {
    const response = await axios.get("/api/tasks");
    const originalTasks = response.data;
    kanban.phases = originalTasks.reduce((acc, cur) => {
      acc[cur.id] = cur;
      return acc;
    }, {});
  } catch (error) {
    console.error("There was an error fetching the tasks!", error);
  }
};

async function createCompletedPhase() {
  // Implement this function to create a new phase in your backend
}

async function moveCompletedTasks(completedPhaseId) {
  // Implement this function to move completed tasks to the new phase
}
</script>


<style scoped>

.scrollable-div {
    height: 40rem;
    overflow-y: scroll;
    border: 1px solid #ccc;
  }

  .scrollable-div::-webkit-scrollbar {
    display: none;
  }

  * {
    -ms-overflow-style: none;
    scrollbar-width: none;
  }
</style>
