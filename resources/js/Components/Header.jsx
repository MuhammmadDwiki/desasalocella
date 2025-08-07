import {
    Sheet,
    SheetContent,
    SheetDescription,
    SheetHeader,
    SheetTitle,
    SheetTrigger,
} from "@/components/ui/sheet";
import { CiMenuFries } from "react-icons/ci";
import NavLink from "./NavLink";
import Dropdown from "./Dropdown";
import { Link } from "@inertiajs/react";
import { useForm } from "@inertiajs/react";
import { FaUserCircle } from "react-icons/fa";
import { FaSearch } from "react-icons/fa";
import { Input } from "@/components/ui/input"

const Header = (props) => {
    const { post } = useForm();
    const handleLogout = (e) => {
        e.preventDefault();
        post(route("logout"), {
            onFinish: () => (window.location.href = "/"), // Force redirect ke halaman utama
        });
    };
    return (
        <header className="w-full border shadow-md flex z-80 ">
            <div className="container mx-auto ">
                <div className="flex items-center justify-between py-4">
                    <div className="flex ms-4">
                        <div className="text-lg">
                            <h1>{props.headerName}</h1>
                        </div>
                    </div>
                    <div className="flex items-center">
                        <div className="pe-4">
                            <Input type="search" placeholder={`Search`} className="rounded-xl"/>
                        </div>
                        {/* <div>
                            <Dropdown>
                                <Dropdown.Trigger>
                                    <div className="flex rounded-md items-center">
                                        <button
                                            type="button"
                                            className="flex items-center  gap-2  px-3 py-1 text-md font-medium leading-4 text-gray-600 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                                        >
                                            <FaUserCircle className="text-4xl" />
                                            <span className="flex flex-col">
                                                <p>John Doe</p>
                                                <p className="text-sm">admin</p>
                                            </span>
                                        </button>
                                    </div>
                                </Dropdown.Trigger>

                                <Dropdown.Content>
                                    <form onSubmit={handleLogout}>
                                        <button type="submit" className="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 transition duration-150 ease-in-out hover:bg-gray-100 focus:bg-gray-100 focus:outline-none ">Log Out</button>
                                    </form>
                                </Dropdown.Content>
                            </Dropdown>
                        </div> */}

                        {/* <div className="ms-6 flex items-center pe-10">
                            <div className="relative ms-3">
                                <form onSubmit={handleLogout}>
                                    <button type="submit">Log Out</button>
                                </form>
                            </div>
                        </div> */}

                        <div className="xl:hidden block">
                            <Sheet>
                                <SheetTrigger className="cursor-pointer text-[30px] text-black">
                                    <CiMenuFries />
                                </SheetTrigger>

                                <SheetContent
                                    className="bg-primary border-0 flex flex-col justify-center items-center pt-16 pb-20"
                                    side="left"
                                >
                                    <SheetHeader className="">
                                        {/* <SheetTitle>
                                    <Logo />
                                </SheetTitle> */}
                                        <SheetDescription className="sr-only text-white">
                                            Navigation Menu
                                        </SheetDescription>
                                    </SheetHeader>
                                    <NavLink
                                        containerStyles="flex flex-col gap-6 w-full px-6 text-white "
                                        childStyles="relative z-10 rounded py-4 flex items-center px-4 gap-4 hover:bg-gray-400 transition-all duration-300 "
                                    />
                                </SheetContent>
                            </Sheet>
                        </div>
                    </div>
                </div>
            </div>
        </header>
    );
};

export default Header;
