<template>
  <div>
        <navbar></navbar>
        <hero></hero>
        <about></about>
        <how-it-works></how-it-works>
        <program></program>
        <products-list></products-list>
        <instagram></instagram>
        <faq></faq>
        <contact></contact>
        <footer-section></footer-section>
  </div>
</template>

<script>
import Navbar from './Navbar'
import Hero from './Hero'
import About from './About'
import HowItWorks from './HowItWorks'
import Program from './Program'
import ProgramCard from './ProgramCard'
import ProductsList from './ProductsList'
import Instagram from "./Instagram";
import Faq from "./Faq";
import Contact from "./Contact";
import FooterSection from './FooterSection'
export default {
    name: 'app',
    components: {
        ProductsList,
        Navbar,
        Hero,
        About,
        HowItWorks,
        Program,
        ProgramCard,
        Instagram,
        Faq,
        Contact,
        FooterSection
    },
    data(){
        return{
            programInfo: [],
            isVisible: false,
            isDetails: false
        }
    },
    methods: {
        showModal(value){
            this.programInfo = value;
            this.isVisible = true;
        },
        closeModal(){
            this.isVisible = false;
        },
        setDetails(){
            this.isDetails = true;
        }
    }
}
</script>

