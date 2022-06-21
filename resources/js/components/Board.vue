<template>
    <div class="relative p-2 d-flex justify-content-center">
        <!-- Columns (Statuses) -->
        <div
            v-for="status in statuses"
            :key="status.slug"
            class="mr-6 w-25 card bg-dark m-4"
        >
            <div class="overflow-hidden">
                <div class="p-3 d-flex justify-content-between align-baseline">
                    <h4 class="font-medium text-white font-weight-bold">
                        {{ status.title }}
                    </h4>
                </div>
                <div class="p-2 d-flex flex-column h-100 overflow-x-hidden overflow-y-auto"                >
                    <!-- Tasks -->
                    <draggable
                        class="flex-1 overflow-hidden"
                        v-model="status.tasks"
                        v-bind="taskDragOptions"
                        @end="handleTaskMoved"
                    >
                        <transition-group
                            class="flex-1 flex flex-col h-full overflow-x-hidden overflow-y-auto rounded shadow-xs"
                            tag="div"
                        >
                            <div
                                v-for="task in status.tasks"
                                :key="task.id"
                                :style="task.color"
                                class="mb-3 p-3 h-24 d-flex flex-column rounded-md shadow transform hover:shadow-md cursor-pointer"
                            >
                                <h6 class="block mb-2 text-xl text-white font-weight-bolder">
                                  {{ task.title }}
                                </h6>
                                <p class="text-white">
                                    {{ task.description }}
                                </p>
                            </div>
                            <!-- ./Tasks -->
                        </transition-group>
                    </draggable>

                    <!-- No Tasks -->
                    <div
                        v-if="(!status.tasks.length)"
                        class="flex-grow-1 p-4 d-flex flex-column align-items-center justify-content-center"
                    >
                        <span class="text-white">No tasks yet</span>
                    </div>
                    <!-- ./No Tasks -->
                </div>
            </div>
        </div>
        <!-- ./Columns -->
    </div>
</template>

<script>
import draggable from "vuedraggable";
export default {
    name: "Board",
    components: { draggable },
    props: {
        initialData: Array
    },
    computed: {
        taskDragOptions() {
            return {
                animation: 200,
                group: "task-list",
                dragClass: "status-drag"
            };
        }
    },
    data() {
        return {
            statuses: []
        };
    },
    mounted() {
        // 'clone' the statuses so we don't alter the prop when making changes
        this.statuses = JSON.parse(JSON.stringify(this.initialData));
    },
    methods: {
        // ...
        handleTaskMoved() {
            // Send the entire list of statuses to the server
            axios.put("/tasks/sync", {columns: this.statuses}).catch(err => {
                console.log(err.response);
            });
        }
    }
}
</script>

<style scoped>

</style>
