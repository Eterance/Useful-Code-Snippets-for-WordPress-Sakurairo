# Useful Code Snippets for WordPress Sakurairo

## 这是什么

这是一些代码片段，用于深度自定义 WordPress 上的 [Sakurairo](https://github.com/mirai-mamori/Sakurairo) 主题。

更详细的使用说明、示例和效果展示，参见 [使用代码深度定制 WordPress Sakurairo 主题](https://blog.baldcoder.top/articles/customizing-the-wordpress-sakurairo-theme-with-code/)。

## 所需插件

- 安装插件 [Code Snippets](https://cn.wordpress.org/plugins/code-snippets/)。这个插件用于不修改主题文件的情况下添加 php、js 代码。
- 安装插件  [Simple Custom CSS and JS](https://cn.wordpress.org/plugins/custom-css-js/)。这个插件用于不修改主题文件的情况下添加 html、css 代码。（上一个插件也可以，但是要收费）。

## 介绍

### 禁用深色模式封面图变色

css：[disable_pic_color_change_in_dark_mode.css](https://github.com/Eterance/Useful-Code-Snippets-for-WordPress-Sakurairo/blob/main/disable_pic_color_change_in_dark_mode.css)

深色模式下，Sakurairo 会把首页封面大图的色调变得很奇怪。Github 已经有人提了 [issue](https://github.com/mirai-mamori/Sakurairo/issues/501)，但是作者似乎不认为这个是 bug 而是 feature……

### 微软文档风格的提示块-预设版

php：[ms_docs_hint_preset.php](https://github.com/Eterance/Useful-Code-Snippets-for-WordPress-Sakurairo/blob/main/Microsoft_Docs_Style_Hint_Block/ms_docs_hint_preset.php)

css：[ms_docs_hint_preset.css](https://github.com/Eterance/Useful-Code-Snippets-for-WordPress-Sakurairo/blob/main/Microsoft_Docs_Style_Hint_Block/ms_docs_hint_preset.css)

内置了五种不同的仿微软文档样式的提示块。原版详见：[https://learn.microsoft.com/zh-cn/contribute/markdown-reference](https://learn.microsoft.com/zh-cn/contribute/markdown-reference)

### 微软文档风格的提示块-通用版

php：[ms_docs_hint_general.php](https://github.com/Eterance/Useful-Code-Snippets-for-WordPress-Sakurairo/blob/main/Microsoft_Docs_Style_Hint_Block/ms_docs_hint_general.php)

如果上面五种内置的版本还不能满足需求，可以使用能高度自定义的通用版。

### 获取标签目录

php：[get_tag_directory.php](https://github.com/Eterance/Useful-Code-Snippets-for-WordPress-Sakurairo/blob/main/get_tag_directory.php)

需要先使用 Composer 将  [overtrue/pinyin](https://github.com/overtrue/pinyin) 安装到当前主题上。 参见：[WordPress 使用 Composer 安装第三方依赖，并在主题 functions.php 中启用](https://blog.baldcoder.top/articles/wordpress-%e4%bd%bf%e7%94%a8-composer-%e5%ae%89%e8%a3%85%e7%ac%ac%e4%b8%89%e6%96%b9%e4%be%9d%e8%b5%96%ef%bc%8c%e5%b9%b6%e5%9c%a8%e4%b8%bb%e9%a2%98-functions-php-%e4%b8%ad%e5%90%af%e7%94%a8/)

效果见 [标签目录](https://blog.baldcoder.top/tag-dir/) 。

### 友情链接

[Sakurairo 主题自带的友情链接模板](https://docs.fuukei.org/Sakurairo/Templates/#%E5%8F%8B%E6%83%85%E9%93%BE%E6%8E%A5%E6%A8%A1%E6%9D%BF)过于紧凑、不能排序、显示不了长文本。因此自己写了一个。适配移动端视图。当然，也可以做除了友链之外的其他链接。

php：[friend_link.php](https://github.com/Eterance/Useful-Code-Snippets-for-WordPress-Sakurairo/blob/main/friend_link/friend_link.php)

css：[friend_link.css](https://github.com/Eterance/Useful-Code-Snippets-for-WordPress-Sakurairo/blob/main/friend_link/friend_link.css)

效果见 [友情链接](https://blog.baldcoder.top/friendly-link/) 页面。

### 专栏链接

php：[column_link.php](https://github.com/Eterance/Useful-Code-Snippets-for-WordPress-Sakurairo/blob/main/column_link/column_link.php)

css：[column_link.css](https://github.com/Eterance/Useful-Code-Snippets-for-WordPress-Sakurairo/blob/main/column_link/column_link.css)

效果见 [专栏](https://blog.baldcoder.top/columns/) 页面。

### 导航栏模糊背景

css：[navigation_bar_blur.css](https://github.com/Eterance/Useful-Code-Snippets-for-WordPress-Sakurairo/blob/main/navigation_bar_blur.css)