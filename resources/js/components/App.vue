<template>
  <div>
        <navbar></navbar>
        <hero></hero>
        <div id="about">
            <about></about>
        </div>
        <div id="how-it-works">
            <how-it-works></how-it-works>
        </div>
        <div id="programs">
            <program></program>
        </div>
        <div id="sample">
            <sample-menu></sample-menu>
        </div>
        <div id="detox">
            <detox-section></detox-section>
        </div>
        <div id="instagram">
            <instagram></instagram>
        </div>
        <div id="faq">
            <faq></faq>
        </div>
        <!--<div id="quiz">
            <quiz></quiz>
        </div>-->
        <div id="contact">
            <contact></contact>
        </div>
        <footer-section></footer-section>
  </div>
</template>

<script>
import Navbar from './Navbar';
import Hero from './Hero';
import About from './About';
import HowItWorks from './HowItWorks';
import Program from './Program';
import SampleMenu from "./SampleMenu";
import DetoxSection from "./DetoxSection";
import Instagram from "./Instagram";
import Faq from "./Faq";
import Contact from "./Contact";
import FooterSection from './FooterSection';
export default {
    name: 'app',
    components: {
        Navbar,
        Hero,
        About,
        HowItWorks,
        Program,
        SampleMenu,
        DetoxSection,
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

