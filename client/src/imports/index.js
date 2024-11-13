// script for imports all pages 

// dependences
import React, { useState, useEffect, useRef, useMemo, useCallback, useContext } from "react";
import { BrowserRouter as Router, Routes, Route, Link, useNavigate, useParams, useLocation } from "react-router-dom";
import Swal from "sweetalert2";
import Typewriter from 'typewriter-effect';


// img
import Menu from "../assets/img/menu.png";
import Facebook from "../assets/img/facebook_1.png";
import Youtube from "../assets/img/youtube.png";
import Search from "../assets/img/search.png";
import Menu_Vertical from "../assets/img/menu-vertical.png";
import Arrow_Right from "../assets/img/arrow-right.png";
import Arrow_Left from "../assets/img/arrow-left.png";
import Tik_Tok from "../assets/img/tik-tok.png";
import Number_Sign from "../assets/img/number-sign.png";
import Quotation from "../assets/img/quotation-mark.png";
import Music_Icon from "../assets/img/music.png";
import Robot_Icon from "../assets/img/robot.png";
import Cinema_Icon from "../assets/img/cinema.png";
import Twitter from "../assets/img/twitter.png";
import Fair from "../assets/img/fair.png";
import Book from "../assets/img/book.png";
import Persons from "../assets/img/persons.png";
import Cert from "../assets/img/cert.png";
import Whatsapp from "../assets/img/whatsapp.png";
import Email from "../assets/img/mail.png";
import CorpoSer from "../assets/img/CorpoSer.png";
import ChinchinaES from "../assets/img/ChinchinaES.png";
import EsferaCafe from "../assets/img/EsferaCafe.png";
import special from "../assets/img/special.png";
import culture from "../assets/img/culture.png";
import BookMenu from "../assets/img/BookMenu.png";
import arts from "../assets/img/arts.png";
import MusicMenu from "../assets/img/MusicMenu.png";
import gastronomy from "../assets/img/gastronomy.png";
import world from "../assets/img/world.png";
import lost from "../assets/img/lost.svg";
import fire from "../assets/img/fire.svg";
import brand from "../assets/img/brand.png";


// mp4
import Video_bg from "../assets/mp4/fondo_circuits.mp4";


// global context 
import Global_Context from "../components/global_context/context";
import { Provider_Context } from "../components/global_context/provider";

// pages
import DFC from "../pages/dfc/dfc";
import Revista from "../pages/revista/revista";
import Terms from "../pages/terms/terms";
import Lost from "../pages/lost";
import Home from "../pages/home/home";


// components 
import Button from "../components/elements/button";
import Footer_Home from "../pages/home/componets/footer";
import Navbar_Home from "../pages/home/componets/navbar";
import Publications from "../pages/revista/components/utils/publications";
import Carousel from "../pages/revista/components/utils/carousel";
import Category from "../pages/revista/components/category";
import Navbar_revista from "../pages/revista/components/utils/navbar";
import Search_revista from "../pages/revista/components/search";
import Content from "../pages/revista/components/principal";
import Publication_revista from "../pages/revista/components/publication";
import Introduction from "../pages/dfc/components/introduction";
import Event from "../pages/dfc/components/event";
import Inscriptions from "../pages/dfc/components/inscriptions";
import Projects from "../pages/dfc/components/projects";
import Stripe from "../pages/dfc/components/stripe";
import Navbar_dfc from "../pages/dfc/components/navbar";
import Slider_dfc from "../pages/dfc/utils/slider";
import Slogans from "../pages/dfc/utils/slogan";
import Carousel_DFC from "../pages/dfc/utils/carousel_infinite";
import Coming from "../pages/dfc/components/coming";
import Publications_Author from "../pages/revista/components/utils/publications_author";
import Form_Inscriptions from "../pages/dfc/utils/form";



// custom hooks
import useScroll from "../components/custom_hooks/useScroll";
import useCarousel from "../components/custom_hooks/useCarousel";
import useFuntions from "../components/custom_hooks/useFuntions";
import useSearch from "../components/custom_hooks/useSearch";
import useCounter from "../components/custom_hooks/useCounter";
import useMouseEvent from "../components/custom_hooks/useMouseEvent";
import useCarousel_Infinite from "../components/custom_hooks/useCarousel_infinite";
import useNavigation from "../components/custom_hooks/useNavigation";
import usePagination from "../components/custom_hooks/usePagination";
import useMathRamdon from "../components/custom_hooks/useMathRamdon";

// fetch
import useGetAdvertising from "../components/fetch/actions/get/useGetAdvertising";
import useGetDfc from "../components/fetch/actions/get/useGetDfc";
import useGetHashtags from "../components/fetch/actions/get/useGetHashtags";
import useGetImageBank from "../components/fetch/actions/get/useGetImageBank";
import useGetRevista from "../components/fetch/actions/get/useGetRevista";
import useGetVideoBank from "../components/fetch/actions/get/useGetVideoBank";
import usePostSearch from "../components/fetch/actions/post/usePostSearch";
import usePostPublication from "../components/fetch/actions/post/usePostPublication";
import usePostPublicationAuthor from "../components/fetch/actions/post/usePostPublicationAuthor";
import usePostElementsPublication from "../components/fetch/actions/post/usePostElementsPublication";
import usePostIFormInscriptions from "../components/fetch/actions/post/usePostFormInscriptions";

// exports
export { React, useLocation, useState, useEffect, useRef, useMemo, useCallback, useContext, Router, Routes, Route, Link, useNavigate, useParams, Swal, Typewriter };
export { Global_Context, Provider_Context };
export { Music_Icon, brand, fire, lost, culture, BookMenu, arts, MusicMenu, gastronomy, world, special, CorpoSer, ChinchinaES, EsferaCafe, Whatsapp, Email, Cert, Persons, Book, Fair, Twitter, Cinema_Icon, Robot_Icon, Quotation, Menu, Facebook, Number_Sign, Youtube, Tik_Tok, Search, Menu_Vertical, Arrow_Left, Arrow_Right };
export { Video_bg };
export { Terms, Revista, DFC, Lost, Home };
export { Button, Form_Inscriptions, Publications_Author, Coming, Carousel_DFC, Slogans, Introduction, Slider_dfc, Event, Inscriptions, Projects, Stripe, Navbar_dfc, Footer_Home, Navbar_Home, Publications, Carousel, Category, Navbar_revista, Search_revista, Content, Publication_revista };
export { useScroll, useMathRamdon, usePagination, useNavigation, useCarousel_Infinite, useCarousel, useFuntions, useSearch, useCounter, useMouseEvent };
export { useGetAdvertising, usePostIFormInscriptions, usePostPublication, usePostPublicationAuthor, usePostSearch, useGetDfc, useGetHashtags, useGetImageBank, useGetRevista, useGetVideoBank, usePostElementsPublication };