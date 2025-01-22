import {
    type LucideIcon,
} from "lucide-react"

import {
    SidebarGroup,
    SidebarGroupLabel,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from "@/components/ui/sidebar"

export function NavItems({
    data,
}: {
    data: {
        title: string,
        items : {
            name: string
            url: string
            icon: LucideIcon
        }[]
    }
}) {

    return (
    <SidebarGroup className="group-data-[collapsible=icon]:hidden">
        <SidebarGroupLabel>{data.title}</SidebarGroupLabel>
        <SidebarMenu>
        {data.items.map((item) => (
            <SidebarMenuItem key={item.name}>
            <SidebarMenuButton asChild>
                <a href={item.url}>
                <item.icon />
                <span>{item.name}</span>
                </a>
            </SidebarMenuButton>
            </SidebarMenuItem>
        ))}
        </SidebarMenu>
    </SidebarGroup>
    )
}
