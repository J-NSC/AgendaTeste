import {
    MenuIcon,
    CircleIcon,
    CircleOffIcon,
    BrandChromeIcon,
    MoodSmileIcon,
    StarIcon,
    AwardIcon
} from 'vue-tabler-icons';

export interface menu {
    header?: string;
    title?: string;
    icon?: any;
    to?: string;
    chip?: string;
    chipBgColor?: string;
    chipColor?: string;
    chipVariant?: string;
    chipIcon?: string;
    children?: menu[];
    disabled?: boolean;
    type?: string;
    subCaption?: string;
}

const sidebarItem: menu[] = [
    {
        title: 'Disabled',
        icon: CircleOffIcon,
        disabled: true,
        to: '/flexy'
    },
    {
        title: 'Sub Caption',
        icon: StarIcon,
        subCaption: 'This is the subtitle',
        to: '/flexy'
    },
    {
        title: 'Chip',
        icon: AwardIcon,
        chip: '9',
        chipColor: 'surface',
        chipBgColor: 'secondary',
        to: '/flexy'
    },
    {
        title: 'Outlined',
        icon: MoodSmileIcon,
        chip: 'outline',
        chipColor: 'secondary',
        chipVariant: 'outlined',
        to: '/flexy'
    },
    {
        title: 'External Link',
        icon: StarIcon,
        to: '/flexy',
        type: 'external'
    }
];

export default sidebarItem;
