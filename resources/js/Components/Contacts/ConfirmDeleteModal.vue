<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
    open: { type: Boolean, default: false },
    contact: { type: Object, default: null },
})
const emit = defineEmits(['update:open', 'deleted'])

const form = useForm({})

function close () { emit('update:open', false) }

function confirmDelete () {
    if (!props.contact) return
    form.delete(route('contact.destroy', props.contact.id), {
        preserveScroll: true,
        onSuccess: () => { emit('deleted'); close() },
        onFinish: () => { form.reset() },
    })
}
</script>

<template>
    <div v-if="open" class="fixed inset-0 z-50 grid place-items-center p-4">
        <div class="absolute inset-0 bg-black/40" @click="close" />
        <div class="relative w-full max-w-sm rounded-xl bg-white shadow-xl">
            <div class="px-5 py-4 border-b">
                <h3 class="text-lg font-semibold text-gray-800">Excluir contato</h3>
            </div>

            <div class="px-5 py-4 text-gray-700">
                Tem certeza que deseja excluir
                <span class="font-medium">{{ contact?.name }}</span>?
                Esta ação não pode ser desfeita.
            </div>

            <div class="px-5 py-4 flex justify-end gap-3 border-t">
                <button type="button" class="px-4 py-2 rounded-md border text-gray-700 hover:bg-gray-50"
                        @click="close">Cancelar</button>
                <button type="button" :disabled="form.processing"
                        class="px-4 py-2 rounded-md text-white bg-red-600 hover:bg-red-700 disabled:opacity-50"
                        @click="confirmDelete">
                    {{ form.processing ? 'Excluindo...' : 'Excluir' }}
                </button>
            </div>
        </div>
    </div>
</template>
