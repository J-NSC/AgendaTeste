<script setup>
import { Head, useForm } from '@inertiajs/vue3'
import { ref, watch, computed } from 'vue'

const props = defineProps({
    open: { type: Boolean, default: false },
    mode: { type: String, default: 'create' },
    contact: { type: Object, default: null },
})

const emit = defineEmits(['update:open', 'success'])

const imagePreview = ref(null)

const form = useForm({
    name: '',
    phone: '',
    email: '',
    image: null,
})

watch(
    () => props.open,
    (isOpen) => {
        if (isOpen) {
            if (props.mode === 'edit' && props.contact) {
                form.name  = props.contact.name ?? ''
                form.phone = props.contact.phone ?? ''
                form.email = props.contact.email ?? ''
                imagePreview.value = props.contact.image_path ? `/storage/${props.contact.image_path}` : null
            } else {
                resetForm()
            }
        }
    }
)

function resetForm() {
    form.reset()
    form.clearErrors()
    imagePreview.value = null
}

function close() {
    emit('update:open', false)
    resetForm()
}

function onFileChange(e) {
    const file = e.target.files?.[0] || null
    form.image = file
    imagePreview.value = file ? URL.createObjectURL(file) : imagePreview.value
}


function submit() {
    const options = {
        onSuccess: () => {
            emit('success')
            close()
        },
        forceFormData: true,
    }

    if (props.mode === 'edit' && props.contact) {
        const updateOptions = { ...options, preserveScroll: true }

        form
            .transform((data) => {
                const newData = { ...data, _method: 'put' };

                if (!newData.image) {
                    delete newData.image;
                }

                return newData;
            })
            .post(route('contact.update', props.contact.id), updateOptions)

        form.transform((data) => data);

    } else {
        form.post(route('contact.store'), options)
    }
}
</script>

<template>
    <div v-if="open" class="fixed inset-0 z-50 flex items-center justify-center p-4" aria-modal="true" role="dialog">
        <div class="fixed inset-0 bg-black/40" @click="close"></div>

        <div class="relative w-full max-w-lg bg-white rounded-xl shadow-xl overflow-hidden">
            <div class="px-6 py-4 border-b bg-gray-50 flex justify-between items-center">
                <h3 class="text-lg font-semibold text-gray-700">
                    {{ mode === 'edit' ? 'Editar Contato' : 'Novo Contato' }}
                </h3>
                <button class="text-gray-500 hover:text-gray-700" @click="close" aria-label="Fechar">✕</button>
            </div>

            <form @submit.prevent="submit" class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nome *</label>
                    <input v-model="form.name" type="text"
                           class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required />
                    <div v-if="form.errors.name" class="text-sm text-red-600 mt-1">{{ form.errors.name }}</div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Telefone *</label>
                    <input v-model="form.phone" type="text"
                           x-mask="(99) 99999-9999"
                           class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" required />
                    <div v-if="form.errors.phone" class="text-sm text-red-600 mt-1">{{ form.errors.phone }}</div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">E-mail</label>
                    <input v-model="form.email" type="email"
                           class="mt-1 block w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" />
                    <div v-if="form.errors.email" class="text-sm text-red-600 mt-1">{{ form.errors.email }}</div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Imagem</label>
                    <input @change="onFileChange" type="file" accept="image/*" class="mt-1 block w-full text-sm text-gray-700" />
                    <div v-if="form.errors.image" class="text-sm text-red-600 mt-1">{{ form.errors.image }}</div>

                    <div v-if="imagePreview" class="mt-3">
                        <img :src="imagePreview" alt="Pré-visualização" class="h-20 w-20 rounded-full object-cover border" />
                    </div>
                </div>

                <div class="pt-2 flex items-center justify-end gap-3">
                    <button type="button" class="px-4 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-50"
                            @click="close">Cancelar</button>
                    <button type="submit" :disabled="form.processing"
                            class="px-4 py-2 rounded-md text-white bg-indigo-600 hover:bg-indigo-700 disabled:opacity-50">
                        {{ form.processing ? 'Salvando...' : (mode === 'edit' ? 'Salvar alterações' : 'Salvar') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
