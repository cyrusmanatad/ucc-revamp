import * as React from "react"
import {
  AudioWaveform,
  BookOpen,
  ChartColumn,
  CogIcon,
  Command,
  Frame,
  GalleryVerticalEnd,
  GlobeIcon,
  Home,
  ListOrderedIcon,
  LogsIcon,
  Map,
  PieChart,
  Settings2,
  SquareMenu,
  SquarePen,
  SquareTerminal,
  Trash2Icon,
  Users,
} from "lucide-react"

import { NavMain } from "@/components/nav-main"
import { NavOthers } from "@/components/nav-others"
import { NavUser } from "@/components/nav-user"
import { TeamSwitcher } from "@/components/team-switcher"
import {
  Sidebar,
  SidebarContent,
  SidebarFooter,
  SidebarGroup,
  SidebarHeader,
  SidebarMenu,
  SidebarMenuButton,
  SidebarMenuItem,
  SidebarRail,
} from "@/components/ui/sidebar"
import { ScrollArea } from "./ui/scroll-area"
import { NavItems } from "./customs/nav-items"

// This is sample data.
const data = {
  user: {
    name: "Cyrus",
    email: "c_camanatad@unilab.com.ph",
    avatar: "/avatars/shadcn.jpg",
  },
  teams: [
    {
      name: "Unahco Central Credit",
      logo: GalleryVerticalEnd,
      plan: "Enterprise",
    },
    {
      name: "Acme Corp.",
      logo: AudioWaveform,
      plan: "Startup",
    },
    {
      name: "Evil Corp.",
      logo: Command,
      plan: "Free",
    },
  ],
  navMain: [
    {
      title: "Users",
      url: "#",
      icon: Users,
      isActive: true,
      items: [
        {
          title: "List",
          url: "#",
        },
        {
          title: "Roles",
          url: "#",
        },
        {
          title: "Tagging",
          url: "#",
        },
      ],
    },
    {
      title: "Sites",
      url: "#",
      icon: GlobeIcon,
      items: [
        {
          title: "UCC",
          url: "#",
        }
      ],
    },
    {
      title: "Site Maintenance",
      url: "#",
      icon: CogIcon,
      items: [
        {
          title: "UCC",
          url: "#",
        }
      ],
    },
    {
      title: "Menus",
      url: "#",
      icon: SquareMenu,
      items: [
        {
          title: "Site Menu",
          url: "#",
        },
        {
          title: "CMS Menu",
          url: "#",
        },
      ],
    },
    {
      title: "Documentation",
      url: "#",
      icon: BookOpen,
      items: [
        {
          title: "Introduction",
          url: "#",
        },
        {
          title: "Get Started",
          url: "#",
        },
        {
          title: "Tutorials",
          url: "#",
        },
        {
          title: "Changelog",
          url: "#",
        },
      ],
    },
    {
      title: "Settings",
      url: "#",
      icon: Settings2,
      items: [
        {
          title: "General",
          url: "#",
        },
        {
          title: "Team",
          url: "#",
        },
        {
          title: "Billing",
          url: "#",
        },
        {
          title: "Limits",
          url: "#",
        },
      ],
    },
    {
      title: "Logs",
      url: "#",
      icon: LogsIcon,
      items: [
        {
          title: "Audit Trail",
          url: "#",
        },
        {
          title: "Error Logs",
          url: "#",
        }
      ],
    },
  ],
  orders: {
    title: "Orders",
    items: [
      {
        name: "Create Order",
        url: "#",
        icon: SquareTerminal,
      },
      {
        name: "Processed",
        url: "#",
        icon: ListOrderedIcon,
      },
      {
        name: "Draft",
        url: "#",
        icon: SquarePen,
      },
      {
        name: "Trash",
        url: "#",
        icon: Trash2Icon,
      }
    ]
  },
  reports: {
    title: "Reports",
    items: [
      {
        name: "Processed Orders",
        url: "#",
        icon: ChartColumn,
      },
      {
        name: "Inventory Summary",
        url: "#",
        icon: ChartColumn,
      }
    ]
  },
  others: [
    {
      name: "Design Engineering",
      url: "#",
      icon: Frame,
    },
    {
      name: "Sales & Marketing",
      url: "#",
      icon: PieChart,
    },
    {
      name: "Travel",
      url: "#",
      icon: Map,
    },
  ],
}

export function AppSidebar({ ...props }: React.ComponentProps<typeof Sidebar>) {
  return (
    <Sidebar collapsible="icon" {...props}>
      <SidebarHeader>
        <TeamSwitcher teams={data.teams} />
      </SidebarHeader>
      <SidebarContent>
        <ScrollArea className="border-0">
          <SidebarGroup className="group-data-[collapsible=icon]:hidden">
            <SidebarMenu>
              <SidebarMenuItem key="Dashboad">
                <SidebarMenuButton asChild>
                    <a href="#">
                      <Home/>
                      <span>Dashboad</span>
                    </a>
                </SidebarMenuButton>
              </SidebarMenuItem>
          </SidebarMenu>
          </SidebarGroup>
          <NavMain items={data.navMain} />
          <NavItems data={data.orders}/>
          <NavItems data={data.reports}/>
          <NavOthers others={data.others} />
        </ScrollArea>
      </SidebarContent>
      <SidebarFooter>
        <NavUser user={data.user} />
      </SidebarFooter>
      <SidebarRail />
    </Sidebar>
  )
}
