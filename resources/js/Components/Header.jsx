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

const Header = () => {
    const { post } = useForm();
    const handleLogout = (e) => {
        e.preventDefault();
        post(route("logout"), {
            onFinish: () => (window.location.href = "/"), // Force redirect ke halaman utama
        });
    };
    return (
        <header className="w-full border flex  ">
            <div className="container mx-auto ">
                <div className="flex items-center justify-between py-6">
                    <div className="ms-6 flex items-center pe-10">
                        <div className="relative ms-3">
                            {/* <Dropdown>
                                <Dropdown.Trigger>
                                    <span className="inline-flex rounded-md">
                                        <button
                                            type="button"
                                            className="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-600 transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none"
                                        >
                                            admin
                                            <svg
                                                className="-me-0.5 ms-2 h-4 w-4"
                                                xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 20 20"
                                                fill="currentColor"
                                            >
                                                <path
                                                    fillRule="evenodd"
                                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                    clipRule="evenodd"
                                                />
                                            </svg>
                                        </button>
                                    </span>
                                </Dropdown.Trigger>

                                <Dropdown.Content>
                                    <Dropdown.Link
                                        href=""
                                        method="post"
                                        as="button"
                                    >
                                        Log Out
                                    </Dropdown.Link>
                                </Dropdown.Content>
                            </Dropdown> */}
                            <form onSubmit={handleLogout}>
                                <button type="submit">Log Out</button>
                            </form>
                        </div>
                    </div>
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
        </header>
    );
};

export default Header;
