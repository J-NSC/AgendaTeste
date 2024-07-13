<script setup>
import {computed, ref, watch} from 'vue';
import {ChevronUpIcon, ChevronDownIcon} from "@heroicons/vue/24/outline/index.js";


const emit = defineEmits(['update:modelValue', 'search']);

const props = defineProps(
    {
        modelValue:{
            type:Object,
            required: true,
        },
        options:{
            type:Array,
        },
        placeholderValue:{
            type:String,
            default: 'opção'
        },
        disable:{
            type:Boolean,
            default:false
        },
        searchable:{
            type: Boolean,
            default: true,
        }
    }
);

const showOptions = ref(false);
const input = ref('');



const value = computed({
    get() {
        if(props.modelValue !== null && props.modelValue !== '' ){
            console.log(props.modelValue)
            return props.modelValue.name ? props.modelValue.name : props.modelValue
        }
        return 'Selecionar ' + props.placeholderValue
    }
})

const updateValue = (item) =>{
    emit('update:modelValue', item);
}

const toggleShowOptions = ()=>{
    if(props.disable){
        return
    }
    showOptions.value = !showOptions.value
    input.value = '';
}

watch(input,async (param)=>{
    //Chama a função de busca do componente pai toda vez que o input for alterado
    emit('search',param);
});
</script>

<template>
    <div class="flex flex-col items-center relative">
        <div v-show="showOptions" class="fixed inset-0 z-40" @click="showOptions = false"></div>
        <div class="w-full ">
            <div class="my-2 p-1 flex border border-gray-300 bg-white rounded-lg">
                <div class="flex flex-auto flex-wrap p-1">
                    <div class="px-1 w-full flex items-center justify-center">
                        <div @click="toggleShowOptions" class=" text-sm bg-transparent p-1 px-2  border-0 rounded-lg  h-full w-full text-gray-800">
                            <span :class="disable ? 'text-gray-300' : ''" >{{value}}</span>
                        </div>
                        <div class="text-gray-300 w-8  pl-2 pr-1  flex items-center border-gray-200">
                            <div @click="toggleShowOptions"
                                 :class="disable ? 'text-gray-300' : 'text-gray-600'"
                                 class="flex items-center cursor-pointer w-6 h-6  outline-none focus:outline-none">
                                <ChevronUpIcon v-if="showOptions" class="feather feather-chevron-up w-4 h-4"/>
                                <ChevronDownIcon v-else class="feather feather-chevron-up w-4 h-4"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="showOptions"
             class="absolute origin-top-right  z-50 shadow top-16 bg-white w-full  rounded-lg  overflow-y-auto max-h-40">
            <div class="flex flex-col w-full">
                <div v-if="searchable" class="cursor-pointer hover:text-white w-full border-gray-100  ">
                    <div class="flex w-full items-center p-2 pl-2 border-transparent  relative hover:border-teal-100">
                        <input :placeholder="'Buscar '+placeholderValue" v-model="input" class="text-primary w-full items-center flex rounded-lg border-gray-300"/>
                    </div>
                </div>
                <div v-for="it in options"
                     class="cursor-pointer hover:text-white w-full border-gray-100  hover:bg-primary ">
                    <div @click="updateValue(it); toggleShowOptions()"
                         class="flex w-full items-center p-2 pl-2 border-transparent  relative hover:border-teal-100">
                        <div class="w-full items-center flex">
                            <div class="mx-2 leading-6  "> {{ it.name? it.name : it }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
