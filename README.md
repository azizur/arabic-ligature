Arabic Ligature
===============

Arabic Ligature will encode common Arabic phrases to respective Ligature using Unicode representation.

[![Build Status](https://travis-ci.org/azizur/arabic-ligature.svg?branch=master)](https://travis-ci.org/azizur/arabic-ligature)

Supported Short Codes:

| Short codes | Ligature | Arabic | Transliteration | Translation |
|:-:|:-:|---:|---|---|
| [basmala]<br />[bismillah] | &#65021; | &#1576;&#1587;&#1605; &#1575;&#1604;&#1604;&#1607; &#1575;&#1604;&#1585;&#1581;&#1605;&#1606; &#1575;&#1604;&#1585;&#1581;&#1610;&#1605; | bismi-llāhi r-raḥmāni r-raḥīm |  In the name of God, most Gracious, most Compassionate |
| [pbuh]<br />[saw]<br />[saaw]<br />[saas]<br />[saww] | &#65018; | &#1589;&#1604;&#1609; &#1575;&#1604;&#1604;&#1607; &#1593;&#1604;&#1610;&#1607; &#1608; &#1587;&#1604;&#1605; | ṣall Allāhu ʿalay-hi wa-sallam | May Allāh honor him and grant him peace |
| [as]<br />[alayhis] | &#1593;&#1604;&#1610;&#1607; &#1575;&#1604;&#1587;&#1604;&#1575;&#1605; | &#1593;&#1604;&#1610;&#1607; &#1575;&#1604;&#1587;&#1604;&#1575;&#1605; | `Alayhi s-salām | Upon Him/Her Be Peace |
| [rahimaha] |  |  |  |  |
| [rahimahu] |  |  |  |  |
| [rahimahum] |  |  |  |  |
| [raa] |  |  |  |  |
| [ranha] |  |  |  |  |
| [ranhu] |  |  |  |  |
| [ranhum] |  |  |  |  |
| [salaam]<br />[sallam] | &#1575;&#1604;&#1587;&#1604;&#1575;&#1605; &#1593;&#1604;&#1610;&#1603;&#1605; | &#1575;&#1604;&#1587;&#1604;&#1575;&#1605; &#1593;&#1604;&#1610;&#1603;&#1605; | As-salamu alaykum | Peace be upon you |
| [wasalaam]<br />[wasallam]<br />[waalaykumu] | &#1608;&#1593;&#1604;&#1610;&#1603;&#1605; &#1575;&#1604;&#1587;&#1604;&#1575;&#1605; | &#1608;&#1593;&#1604;&#1610;&#1603;&#1605; &#1575;&#1604;&#1587;&#1604;&#1575;&#1605; | Wa ‘alaykum al-salaam | And unto you peace |
| [allah] | &#65010; | &#65010; | Allāh | Allah (God) |
| [swt]<br />[jallajalaluh]<br />[jallajalalouhou] | &#xFDFB; | &#1587;&#1576;&#1581;&#1575;&#1606;&#1607; &#1608; &#1578;&#1593;&#1575;&#1604;&#1609; | Jalla Jalāluhu | May He be Glorified and Exalted |


# Development

## Unit Testing

install Dockunit:

```
npm install -g dockunit
```

Run tests
```
dockunit --du-verbose
```
