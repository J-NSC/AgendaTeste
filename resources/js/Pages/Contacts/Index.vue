<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head } from '@inertiajs/vue3'
import { ref } from 'vue'
import ContactModal from '@/Components/Contacts/ContactModal.vue'
import ConfirmDeleteModal from '@/Components/Contacts/ConfirmDeleteModal.vue'

defineProps({ contacts: Array })

const open = ref(false)
const mode = ref('create')
const selected = ref(null)
const openDelete = ref(false)

function openCreate() {
    mode.value = 'create'
    selected.value = null
    open.value = true
}

function openEdit(contact) {
    mode.value = 'edit'
    selected.value = contact
    open.value = true
}

function confirmDelete(contact) {
    selected.value = contact
    openDelete.value = true
}


function formatPhone(phone) {
    if (!phone) return '-'
    const cleaned = phone.replace(/\D/g, '')
    if (cleaned.length <= 10) {
        return cleaned.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3').trim()
    }
    return cleaned.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3').trim()
}
</script>

<template>
    <Head title="Contatos" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h2 class="text-xl font-semibold text-gray-800">Contatos</h2>

                <button
                    @click="openCreate"
                    class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-lg transition"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Adicionar
                </button>
            </div>
        </template>

        <div class="p-4 sm:p-6 max-w-4xl mx-auto">

            <div class="space-y-4 sm:hidden">
                <div
                    v-for="c in contacts"
                    :key="c.id"
                    class="bg-white rounded-xl shadow-sm border border-gray-200 px-4 py-3 flex justify-between items-center"
                >
                    <div class="flex items-center gap-3">
                        <div class="relative flex items-center justify-center w-12 h-12 rounded-full border border-gray-200 overflow-hidden bg-gray-100">
                            <img
                                v-if="c.image_path"
                                :src="`/storage/${c.image_path}`"
                                alt="Foto"
                                class="object-cover w-full h-full"
                            />
                            <span v-else class="text-gray-600 font-semibold uppercase">{{ c.name?.charAt(0) ?? '?' }}</span>
                        </div>

                        <div class="flex flex-col">
                            <p class="text-gray-900 font-medium text-base truncate">{{ c.name }}</p>
                            <p class="text-sm text-gray-500 truncate">{{ formatPhone(c.phone) }}</p>
                            <p class="text-xs text-gray-400">{{ c.email ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <button
                            @click="openEdit(c)"
                            class="text-indigo-600 hover:text-indigo-800 p-2 rounded-full transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15.232 5.232a2.5 2.5 0 113.536 3.536L7.5 20.036H4v-3.536L15.232 5.232z" />
                            </svg>
                        </button>

                        <button
                            @click="confirmDelete(c)"
                            class="text-red-600 hover:text-red-800 p-2 rounded-full transition">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24">
                                <rect width="24" height="24" fill="none" />
                                <path fill="currentColor" d="M7 21q-.825 0-1.412-.587T5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413T17 21zM17 6H7v13h10zM9 17h2V8H9zm4 0h2V8h-2zM7 6v13z" />
                            </svg>
                        </button>
                    </div>

                </div>

                <div v-if="contacts.length === 0" class="text-center text-gray-500 text-sm py-6">
                    Nenhum contato encontrado.
                </div>
            </div>

            <div class="hidden sm:block bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <div class="p-4 flex justify-between items-center border-b border-gray-200 bg-gray-50">
                    <h3 class="text-lg font-semibold text-gray-800">Lista de contatos</h3>
                    <span class="text-sm text-gray-500">{{ contacts.length }} contato(s)</span>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-gray-700">
                        <thead class="bg-gray-50 text-xs uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold">Nome</th>
                            <th class="px-6 py-3 text-left font-semibold">Telefone</th>
                            <th class="px-6 py-3 text-left font-semibold">E-mail</th>
                            <th class="px-6 py-3 text-left font-semibold">Criado em</th>
                            <th class="px-6 py-3 text-right font-semibold">Ações</th>
                        </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100 bg-white">
                        <tr
                            v-for="c in contacts"
                            :key="c.id"
                            class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 flex items-center gap-3">
                                <img
                                    v-if="c.image_path"
                                    :src="`/storage/${c.image_path}`"
                                    class="h-10 w-10 rounded-full object-cover border border-gray-200"
                                />
                                <div
                                    v-else
                                    class="h-10 w-10 rounded-full bg-indigo-600 text-white grid place-items-center font-semibold uppercase"
                                >
                                    {{ c.name ? c.name.charAt(0) : '?' }}
                                </div>

                                <div>
                                    <p class="font-medium text-gray-900">{{ c.name }}</p>
                                    <p class="text-xs text-gray-500">{{ c.email ?? '-' }}</p>
                                </div>
                            </td>

                            <td class="px-6 py-4 text-sm">{{ formatPhone(c.phone) }}</td>

                            <td class="px-6 py-4 text-sm text-gray-600">{{ c.email ?? '-' }}</td>

                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ new Date(c.created_at ?? Date.now()).toLocaleDateString('pt-BR') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button
                                    @click="openEdit(c)"
                                    class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                                    Editar
                                </button>

                                <button
                                    @click="confirmDelete(c)"
                                    class="text-red-600 hover:text-red-800 text-sm font-medium ml-3">
                                    Deletar
                                </button>
                            </td>
                        </tr>

                        <tr v-if="contacts.length === 0">
                            <td colspan="6" class="py-6 text-center text-gray-500">Nenhum contato cadastrado.</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <ContactModal
                v-model:open="open"
                :mode="mode"
                :contact="selected"
            />

            <ConfirmDeleteModal
                v-model:open="openDelete"
                :contact="selected"
                @deleted=""
            />
        </div>
    </AuthenticatedLayout>
</template>
