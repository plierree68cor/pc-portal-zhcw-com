<?php

/**
 * LinkCard - 渲染链接卡片 HTML 片段
 *
 * 此文件提供生成一个带有标题、描述和链接的卡片 HTML 片段的功能。
 * 所有输出内容均经过转义处理，确保安全。
 */

class LinkCard
{
    /**
     * 渲染一个链接卡片 HTML 片段。
     *
     * @param string $url         链接目标 URL
     * @param string $title       卡片标题
     * @param string $description 卡片描述
     * @param string $keyword     关键词，可选，用于额外展示
     * @return string 转义后的 HTML 片段
     */
    public static function render(string $url, string $title, string $description, string $keyword = ''): string
    {
        $escapedUrl = htmlspecialchars($url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedTitle = htmlspecialchars($title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDescription = htmlspecialchars($description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedKeyword = htmlspecialchars($keyword, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $html = '<div class="link-card">';
        $html .= '<a href="' . $escapedUrl . '" target="_blank" rel="noopener noreferrer">';
        $html .= '<h3 class="link-card-title">' . $escapedTitle . '</h3>';
        $html .= '<p class="link-card-desc">' . $escapedDescription . '</p>';
        if ($escapedKeyword !== '') {
            $html .= '<span class="link-card-keyword">' . $escapedKeyword . '</span>';
        }
        $html .= '</a>';
        $html .= '</div>';

        return $html;
    }

    /**
     * 根据配置数组批量渲染多个卡片。
     *
     * @param array $items 配置数组，每项包含 url, title, description, keyword (可选)
     * @return string 拼接后的 HTML 片段
     */
    public static function renderMultiple(array $items): string
    {
        $output = '';
        foreach ($items as $item) {
            $url = $item['url'] ?? '';
            $title = $item['title'] ?? '';
            $description = $item['description'] ?? '';
            $keyword = $item['keyword'] ?? '';
            $output .= self::render($url, $title, $description, $keyword);
        }
        return $output;
    }
}

// 示例数据
$sampleData = [
    [
        'url' => 'https://pc-portal-zhcw.com',
        'title' => '中彩网 - 官方入口',
        'description' => '提供权威的彩票资讯、开奖结果及数据服务。',
        'keyword' => '中彩网',
    ],
    [
        'url' => 'https://pc-portal-zhcw.com/help',
        'title' => '帮助中心',
        'description' => '常见问题解答和使用指南。',
        'keyword' => '帮助',
    ],
];

// 输出示例 HTML（可直接嵌入页面）
// echo LinkCard::renderMultiple($sampleData);