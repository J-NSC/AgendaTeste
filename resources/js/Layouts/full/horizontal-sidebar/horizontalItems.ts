import {
    MenuIcon,
    CircleIcon,
} from 'vue-tabler-icons';

export interface menu {
    header?: string;
    title?: string;
    icon?: any;
    to?: string;
    divider?: boolean;
    chip?: string;
    chipColor?: string;
    chipVariant?: string;
    chipIcon?: string;
    children?: menu[];
    disabled?: boolean;
    subCaption?: string;
    class?: string;
    extraclass?: string;
    type?: string;
}

const horizontalItems: menu[] = [
    {
        title: 'Sample Page',
        icon: CircleIcon,
        to: '/3'
    },
    {
        title: 'Menu Level',
        icon: MenuIcon,
        to: '#',
        children: [
            {
                title: 'Level 1',
                icon: CircleIcon,
                to: '/level1'
            },
            {
                title: 'Level 1',
                icon: CircleIcon,
                to: '/2level',
                children: [
                    {
                        title: 'Level 2',
                        icon: CircleIcon,
                        to: '/flexy'
                    },
                    {
                        title: 'Level 2',
                        icon: CircleIcon,
                        to: '/2.2level',
                        children: [
                            {
                                title: 'Level 3',
                                icon: CircleIcon,
                                to: '/flexy'
                            }
                        ]
                    }
                ]
            }
        ]
    }
];

export default horizontalItems;
