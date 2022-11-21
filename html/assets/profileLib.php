<?php

function printDesc($filename)
{
    switch ($filename)
    {
        case 'BadTouch':
            return "A Bad Touch is a sour, classy and vintage drink. A bad time is when you ask for one of these from anyone but a bartender. 
                    The guy who invented this gets slapped a lot.";
            break;

        case 'Beer':
            return "A Beer is a bubbly, classic and vintage drink. While still made of synthetic chemicals, 
                    this beverage has been engineered to taste as close as possible to the original temptress of alcoholism.";
            break;

        case 'BleedingJane':
            return "A Bleeding Jane is a spicy, classic and sobering drink. 
                    A favorite among teenagers who probably shouldn't be drinking, many believe it's a powerful hangover cure. Stupid teens.";
            break;

        case 'BloomLight':
            return "A Bloom Light is a spicy, promotional and bland drink. It's been described as tasting spicy for the first few drinks, but eventually tastes more
                    and more like sand, but hey; it glows in the dark! <p>Reportedly, this was invented by a bartender at a video game developer conference. 
                    The bartender created a drink that would force attendees to really \"drink in all the bloom\" like the kind put in their games. They were not amused.</p>";
            break;

        case 'BlueFairy':
            return "A Blue Fairy is a sweet, girly and soft drink. As some people call Absinthe \"The Green Fairy\", the inventors of this drink tried to create a sweeter version. 
                    Their first formulas had to be fixed because some people were turning blue-ish green.";
            break;

        case 'Brandtini':
            return "A Brandtini is a sweet, classy and happy drink. For the kind of person who cares more about what others see them drinking than what they actually taste, 
                    you can't really go wrong with this. Unless you're trying to impress someone drinking a Brandtini.";
            break;

        case 'CobaltVelvet':
            return "A Cobalt Velvet is a bubbly, classy and burning drink. The drink tastes velvet-y smooth going down, but a visceral aftertaste burns harder than expected.";
            break;

        case 'CreviceSpike':
            return "A Crevice Spike is a sour, manly and sobering drink. It's deceptively strong and has a different effect from person to person. 
                    Either the best or the worst beverage to have behind the wheel. It's famously underappreciated, but despite critical acclaim, it remains underordered.";
            break;

        case 'FlamingMoai':
            return "A Flaming Moai is a spicy, classy and secret drink. The BTC does not officially stock any drinks by this name, 
                    and the procedure for asking a bartender for one of these varies from location to location. Lucky for you this is a website.";
            break;

        case 'FluffyDream':
            return "A Fluffy Dream is a sour, girly and soft drink. Despite the sourness, it goes down easy and only slightly tastes like medicine. 
                    It's generally frowned upon to buy this for someone you're intending to woo.";
            break;

        case 'FringeWeaver':
            return "A Fringe Weaver is a bubbly, classy, and <b>strong</b> drink, perhaps even the strongest we sell. At its strongest, 18 parts karmotrine will be 
                    giving you something to regret in the morning, provided you last that long. Past that, industrial chemical wholesalers is your only retailer.";
            break;

        case 'FrothyWater':
            return "A Frothy Water is a bubbly, classic and bland drink. Although we will sell you pure water with froth in it if you really want, 
                    who truly knows what is put in the water these days. You might be better off sticking to synthetic chemicals. At least it's non-alcoholic.";
            break;

        case 'GrizzlyTemple':
            return "A Grizzly Temple is a bitter, promotional and bland drink. It doesn't have wide appeal, 
                    but for superfans of the movie it featured in, it's a niche drink with an acquired taste.";
            break;

        case 'GutPunch':
            return "A Gut Punch is a bitter, manly and <b>strong</b> drink. It's as hard as the name sounds, and without being the cheapest drink on the menu, 
                    few patrons would have the stomach to try one. Rough as it is, it's become the favorite drink of many.";
            break;

        case 'Marsblast':
            return "A Marsblast is a spicy, manly and <b>strong</b> drink. There's a distinct upfront taste that some have described as a \"hot brain freeze\". 
            If you can handle that, it's drink is even better in shots.";
            break;

        case 'Mercuryblast':
            return "A Mercuryblast is a sour, classy and burning drink. Like mercury, this drink is a liquid at room temperature. 
                    Other than that, the namesake comes from the especially reflective surface. ";
            break;

        case 'Moonblast':
            return "A Moonblast is a sweet, girly, and happy drink. In contrast to other \"blast\" drinks, 
                    this one is cold, sweet, and alltogether pleasent to drink for extended periods of time.";
            break;

        case 'PianoMan':
            return "A Piano Man is a sour, promotional and <b>strong</b> drink. Although catagorically a depressant, 
                    but this drink is a go-to for those trying to work up the courage to do something or outgoingness just to talk to people. If nothing else, it makes you feel
                    like you're not drinking alone.";
            break;

        case 'PianoWoman':
            return "A Piano Woman is a sweet, promotional and happy drink. 
                    An easy favorite of patrons across the BTC branches, it's the top pick for those celebrating something or just feeling alright.";
            break;

        case 'PileDriver':
            return "A Pile Driver is a bitter, manly and burning drink. It has a fruity aftertaste and a painful after-aftertaste. 
                    It's most popular with older patrons who feel like synthetic alcohol doesn't make you cought like it used to but don't want to drink chemical waste.";
            break;

        case 'SparkleStar':
            return "A Sparkle Star is a sweet, girly, and happy drink. It's foamy and thick, not too dissimilar to a sugary milkshake. Tastes almost like strawberry.";
            break;

        case 'SugarRush':
            return "A Sugar Rush is a sweet, girly and happy drink. It's a super basic drink, being the equivalent of frying an egg for a novice cook. 
                    Despite this simplicity, it's got a beloved taste that stands toe to toe with fancier beverages. Our most popular drink by far.";
            break;

        case 'SunshineCloud':
            return "A Sunshine Cloud is a bitter, girly, and soft drink. It's got a nice fruity aroma, but is deceivingly bitter. It's most popular around MegaChristmas/Festivus.";
            break;

        case 'Suplex':
            return "A Suplex is a bitter, manly and burning drink. It was accidentally invented by a BTC bartender, 
                    and is been a compelling twist on the Pile Driver. Less of a burning feel, but far punchier.";
            break;

        case 'ZenStar':
            return "A Zen Star is a sour, promotional and bland drink. It's creation was the product of bartending curiosity; 
                    what would happen if you mixed 4 equal parts each of Adelhyde, Bronson Extract, Powdered Delta, Flanergide, and Karmotrine? Whatever this is.";
            break;

        default:
            return "Collapse Fluid is the substance which fuels Collapse Technology. It is used in both Collapse and Reverse Collapse processes 
                    and is stored in crystalline capsule containers, which are highly volatile and must be handled carefully.";
            break;
    }
}

function printIngred($filename)
{
    switch ($filename)
    {
        case 'BadTouch':
            return "<p>Contains 2 parts <span class=\"Bronson\">Bronson Extract</span>,<br> 2 parts <span class=\"Delta\">Powdered Delta</span>,<br> 2 parts <span class=\"Flanergide\">Flanergide</span>,<br> 4 parts <span class=\"Karmotrine\">Karmotrine</span>. All on the rocks and mixed.</p>";
            break;

        case 'Beer':
            return "<p>Contains 1 part <span class=\"Adelhyde\">Adelhyde</span>,<br> 2 parts <span class=\"Bronson\">Bronson Extract</span>,<br> 1 part <span class=\"Delta\">Powdered Delta</span>,<br> 2 parts <span class=\"Flanergide\">Flanergide</span>,<br> 4 parts <span class=\"Karmotrine\">Karmotrine</span>. All mixed.</p>";
            break;

        case 'BleedingJane':
            return "<p>Contains 1 part <span class=\"Bronson\">Bronson Extract</span>,<br> 3 parts <span class=\"Delta\">Powdered Delta</span>,<br> 3 parts <span class=\"Flanergide\">Flanergide</span>. All blended.</p>";
            break;

        case 'BloomLight':
            return "<p>Contains 4 parts <span class=\"Adelhyde\">Adelhyde</span>,<br> 1 part <span class=\"Delta\">Powdered Delta</span>,<br> 2 parts <span class=\"Flanergide\">Flanergide</span>,<br> 3 parts <span class=\"Karmotrine\">Karmotrine</span>. All aged, on the rocks and mixed.</p>";
            break;

        case 'BlueFairy':
            return "<p>Contains 4 parts <span class=\"Adelhyde\">Adelhyde</span>,<br> 1 part <span class=\"Flanergide\">Flanergide</span>,<br> with optional <span class=\"Karmotrine\">Karmotrine</span>. All aged and mixed.</p>";
            break;

        case 'Brandtini':
            return "<p>Contains 6 parts <span class=\"Adelhyde\">Adelhyde</span>,<br> 3 parts <span class=\"Delta\">Powdered Delta</span>,<br> 1 part <span class=\"Karmotrine\">Karmotrine</span>. All aged and mixed.</p>";
            break;

        case 'CobaltVelvet':
            return "<p>Contains 2 parts <span class=\"Adelhyde\">Adelhyde</span>,<br> 3 parts <span class=\"Flanergide\">Flanergide</span>,<br> 5 parts <span class=\"Karmotrine\">Karmotrine</span>. All on the rocks and mixed.</p>";
            break;

        case 'CreviceSpike':
            return "<p>Contains 2 parts <span class=\"Delta\">Powdered Delta</span>,<br> 4 parts <span class=\"Flanergide\">Flanergide</span>,<br> with optional <span class=\"Karmotrine\">Karmotrine</span>. All blended.</p>";
            break;

        case 'FlamingMoai':
            return "<p>Contains 1 part <span class=\"Adelhyde\">Adelhyde</span>,<br> 1 part <span class=\"Bronson\">Bronson Extract</span>,<br> 2 parts <span class=\"Delta\">Powdered Delta</span>,<br> 3 parts <span class=\"Flanergide\">Flanergide</span>,<br> 5 parts <span class=\"Karmotrine\">Karmotrine</span>. All mixed.</p>";
            break;

        case 'FluffyDream':
            return "<p>Contains 3 parts <span class=\"Adelhyde\">Adelhyde</span>,<br> 3 parts <span class=\"Delta\">Powdered Delta</span>,<br> with optional <span class=\"Karmotrine\">Karmotrine</span>. All aged and mixed.</p>";
            break;

        case 'FringeWeaver':
            return "<p>Contains 1 part <span class=\"Adelhyde\">Adelhyde</span>,<br> 9 parts <span class=\"Karmotrine\">Karmotrine</span>. All aged and mixed.</p>";
            break;

        case 'FrothyWater':
            return "<p>Contains 1 part <span class=\"Adelhyde\">Adelhyde</span>,<br> 1 part <span class=\"Bronson\">Bronson Extract</span>,<br> 1 part <span class=\"Delta\">Powdered Delta</span>,<br> 1 part <span class=\"Flanergide\">Flanergide</span>. All aged and mixed.</p>";
            break;

        case 'GrizzlyTemple':
            return "<p>Contains 3 parts <span class=\"Adelhyde\">Adelhyde</span>,<br> 3 parts <span class=\"Bronson\">Bronson Extract</span>,<br> 3 parts <span class=\"Delta\">Powdered Delta</span>,<br> 1 part <span class=\"Karmotrine\">Karmotrine</span>. All blended.</p>";
            break;

        case 'GutPunch':
            return "<p>Contains 5 parts <span class=\"Bronson\">Bronson Extract</span>,<br> 1 part <span class=\"Flanergide\">Flanergide</span>,<br> with optional <span class=\"Karmotrine\">Karmotrine</span>. All aged and mixed.</p>";
            break;

        case 'Marsblast':
            return "<p>Contains 6 parts <span class=\"Bronson\">Bronson Extract</span>,<br> 1 part <span class=\"Delta\">Powdered Delta</span>,<br> 4 parts <span class=\"Flanergide\">Flanergide</span>,<br> 2 parts <span class=\"Karmotrine\">Karmotrine</span>. All blended.</p>";
            break;

        case 'Mercuryblast':
            return "<p>Contains 1 part <span class=\"Adelhyde\">Adelhyde</span>,<br> 1 part <span class=\"Bronson\">Bronson Extract</span>,<br> 3 parts <span class=\"Delta\">Powdered Delta</span>,<br> 3 parts <span class=\"Flanergide\">Flanergide</span>,<br> 2 parts <span class=\"Karmotrine\">Karmotrine</span>. All on the rocks and blended.</p>";
            break;

        case 'Moonblast':
            return "<p>Contains 6 parts <span class=\"Adelhyde\">Adelhyde</span>,<br> 1 part <span class=\"Delta\">Powdered Delta</span>,<br> 1 part <span class=\"Flanergide\">Flanergide</span>,<br> 2 parts <span class=\"Karmotrine\">Karmotrine</span>. All on the rocks and blended.</p>";
            break;

        case 'PianoMan':
            return "<p>Contains 2 parts <span class=\"Adelhyde\">Adelhyde</span>,<br> 3 parts <span class=\"Bronson\">Bronson Extract</span>,<br> 5 parts <span class=\"Delta\">Powdered Delta</span>,<br> 5 parts <span class=\"Flanergide\">Flanergide</span>,<br> 3 parts <span class=\"Karmotrine\">Karmotrine</span>. All on the rocks and mixed.</p>";
            break;

        case 'PianoWoman':
            return "<p>Contains 5 parts <span class=\"Adelhyde\">Adelhyde</span>,<br> 5 parts <span class=\"Bronson\">Bronson Extract</span>,<br> 2 parts <span class=\"Delta\">Powdered Delta</span>,<br> 3 parts <span class=\"Flanergide\">Flanergide</span>,<br> 3 parts <span class=\"Karmotrine\">Karmotrine</span>. All aged and mixed.</p>";
            break;

        case 'PileDriver':
            return "<p>Contains 3 parts <span class=\"Bronson\">Bronson Extract</span>,<br> 3 parts <span class=\"Flanergide\">Flanergide</span>,<br> 4 parts <span class=\"Karmotrine\">Karmotrine</span>. All mixed.</p>";
            break;

        case 'SparkleStar':
            return "<p>Contains 2 parts <span class=\"Adelhyde\">Adelhyde</span>,<br> 1 part <span class=\"Delta\">Powdered Delta</span>,<br> with optional <span class=\"Karmotrine\">Karmotrine</span>. All aged and mixed.</p>";
            break;

        case 'SugarRush':
            return "<p>Contains 2 parts <span class=\"Adelhyde\">Adelhyde</span>,<br> 1 part <span class=\"Delta\">Powdered Delta</span>,<br> with optional <span class=\"Karmotrine\">Karmotrine</span>. All mixed.</p>";
            break;

        case 'SunshineCloud':
            return "<p>Contains 2 parts <span class=\"Adelhyde\">Adelhyde</span>,<br> 2 parts <span class=\"Bronson\">Bronson Extract</span>,<br> with optional <span class=\"Karmotrine\">Karmotrine</span>. All on the rocks and blended.</p>";
            break;

        case 'Suplex':
            return "<p>Contains 4 parts <span class=\"Bronson\">Bronson Extract</span>,<br> 3 parts <span class=\"Flanergide\">Flanergide</span>,<br> 3 parts <span class=\"Karmotrine\">Karmotrine</span>. All on the rocks and mixed.</p>";
            break;

        case 'ZenStar':
            return "<p>Contains 4 parts <span class=\"Adelhyde\">Adelhyde</span>,<br> 4 parts <span class=\"Bronson\">Bronson Extract</span>,<br> 4 parts <span class=\"Delta\">Powdered Delta</span>,<br> 4 parts <span class=\"Flanergide\">Flanergide</span>,<br> 4 parts <span class=\"Karmotrine\">Karmotrine</span>. All on the rocks and mixed.</p>";
            break;

        default:
            return "<p>Contains %#% parts collapse fluid.<\p>";
            break;
    }
}

function drinkERROR()
{
    echo "<div class=\"py-2 text-center Stella\"><h2>404, Drink not found.</h2><p>Did you get here by mistake?</p>";
    echo "<img class=\"d-block mx-auto mb-2\" src=\"assets/drinks/ERROR.png\" id=\"borderCALI\"></div>";
    die();
}

?>